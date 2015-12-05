<?php

/**
 * Serialize an array
 * @return multitype:
 */
function getJsonData(){
	$var = get_object_vars($this);
	foreach($var as &$value){
		if(is_object($value) && method_exists($value,'getJsonData')){
			$value = $value->getJsonData();
		}
	}
	return $var;
}


// TODO Enter your bucket and region details (see details below)
$s3FormDetails = getS3Details(Yii::app()->params['bucket'], Yii::app()->params['region']);


/**
 * Get all the necessary details to directly upload a private file to S3
 * asynchronously with JavaScript.
 *
 * @param string $s3Bucket your bucket's name on s3.
 * @param string $region   the bucket's location, see here for details: http://amzn.to/1FtPG6r
 * @param string $acl      the visibility/permissions of your file, see details: http://amzn.to/18s9Gv7
 *
 * @return array ['url', 'inputs'] the forms url to s3 and any inputs the form will need.
 */
function getS3Details($s3Bucket, $region, $acl = 'public-read') {

    // Options and Settings
    $algorithm = "AWS4-HMAC-SHA256";
    $service = "s3";
    $date = gmdate('Ymd\THis\Z');
    $shortDate = gmdate('Ymd');
    $requestType = "aws4_request";
    $expires = '86400'; // 24 Hours
    $successStatus = '201';
    $url = '//' . $s3Bucket . '.' . $service . '-' . $region . '.amazonaws.com';

    // Step 1: Generate the Scope
    $scope = [
        Yii::app()->params['aws_access_key'],
        $shortDate,
        $region,
        $service,
        $requestType
    ];
    $credentials = implode('/', $scope);

    // Step 2: Making a Base64 Policy
    $policy = [
        'expiration' => gmdate('Y-m-d\TG:i:s\Z', strtotime('+6 hours')),
        'conditions' => [
            ['bucket' => $s3Bucket],
            ['acl' => $acl],
            ['starts-with', '$key', ''],
            ['starts-with', '$Content-Type', ''],
            ['success_action_status' => $successStatus],
            ['x-amz-credential' => $credentials],
            ['x-amz-algorithm' => $algorithm],
            ['x-amz-date' => $date],
            ['x-amz-expires' => $expires],
        ]
    ];
    $base64Policy = base64_encode(json_encode($policy));

    // Step 3: Signing your Request (Making a Signature)
    $dateKey = hash_hmac('sha256', $shortDate, 'AWS4' . Yii::app()->params['aws_secret'], true);
    $dateRegionKey = hash_hmac('sha256', $region, $dateKey, true);
    $dateRegionServiceKey = hash_hmac('sha256', $service, $dateRegionKey, true);
    $signingKey = hash_hmac('sha256', $requestType, $dateRegionServiceKey, true);

    $signature = hash_hmac('sha256', $base64Policy, $signingKey);

    // Step 4: Build form inputs
    // This is the data that will get sent with the form to S3
    $inputs = [
        'Content-Type' => '',
        'acl' => $acl,
        'success_action_status' => $successStatus,
        'policy' => $base64Policy,
        'X-amz-credential' => $credentials,
        'X-amz-algorithm' => $algorithm,
        'X-amz-date' => $date,
        'X-amz-expires' => $expires,
        'X-amz-signature' => $signature
    ];

    return compact('url', 'inputs');
}

?> 
        <div class="container">

            <!-- Direct Upload to S3 Form -->
            <form action="<?php echo $s3FormDetails['url']; ?>"
                  method="POST"
                  enctype="multipart/form-data"
                  class="direct-upload">

                <?php foreach ($s3FormDetails['inputs'] as $name => $value) { ?>
                    <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
                <?php } ?>

                <label for="file" id="label_file"></label>
                <!-- Key is the file's name on S3 and will be filled in with JS -->
                <input type="hidden" name="key" value="">
                <input type="file" name="file" id="file_to_upload">

                <!-- Progress Bars to show upload completion percentage -->
                <div class="progress-bar-area"></div>

            </form>

            <!-- This area will be filled with our results (mainly for debugging) -->
            <div>
                <h3>Files</h3>
                <textarea id="uploaded"></textarea>
            </div>
            
            <div id="formulario_fotos"></div>

        </div>


        <script>

        

        
            $(document).ready(function () {           	                              

            	// Para obtener las dimensiones del archivo antes de mandarlo y el tipo de archivo
                res = {};

                loadImage = function (file) {
                    //var fr, img;
                    //this.res = 0;
                    
                    //var _self = this;

               		     
                    
                    /*
                    fr = new FileReader();
                    //fr.onload = createImage;
                    
                    img = document.createElement('img');
                    //img.onload = imageLoaded;

                    if ("<?php //echo $_POST['adulto']; ?>" == "1")  // Para adultos
                    {
                    	if (img.width >= 3000 || img.height >= 3000)
                        {
                            if (file.type == 'image/jpeg')
                            {
                                res.is_valid = true;
                            } else {
                            	res.is_valid = false;
                                res.error = 'Solo se admiten extensiones .jpg';
                            }
                            
                        } else {
                            res.is_valid = false;
                            console.log(img.width);
                            res.error = 'La resolución de tu fotografá es: ' + img.width + 'x' + img.height + 'px; El requisito es que el lado mas grande tu fotogrfá debe ser mínimo de 3000px';
                        }     

                    } else {  // Para jovenes
                    	if (file.type == 'image/jpeg')
                        {
                            res.is_valid = true;
                        } else {
                        	res.is_valid = false;
                            res.error = 'Solo se admiten extensiones .jpg';
                        }
                    }
                    
                    img.src = fr.result;        
                    fr.readAsDataURL(file);*/

                    var reader  = new FileReader();

                    reader.onload   = function(e)
                    {
                        var image   = new Image();
                        //res.width =  'siii';

                        //console.log(res);
                        image.onload    = function()
                        {
                            //console.log(image.width, image.height);
                            res.width =  image.width;
                            //console.log(res.width);
                            
                        };

                        image.src   = e.target.result;
                    };

                    //console.log(res.width);
                    reader.readAsDataURL(file);       
                    return res;
                }








                        
                // Assigned to variable for later use.
                var form = $('.direct-upload');

                // Place any uploads within the descending folders                
                var folders = ["<?php echo $material; ?>", "<?php echo $categoria; ?>"];

                if ("<?php echo $_POST['adulto']; ?>" == "1")  // Para adultos
                	folders.push("adulto");
                else
                	folders.push("juvenil");
        

                form.fileupload({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    datatype: 'xml',
                    add: function (event, data) {

                        // Give the file which is being uploaded it's current content-type (It doesn't retain it otherwise)
                        // and give it a unique name (so it won't overwrite anything already on s3).
                        
                        var file = data.files[0];
                        var filename = "<?php echo $fecha.$usuario; ?>" + '.' + file.name.split('.').pop();
						//var size = file.size;
						//var type = file.type;
                        
                        form.find('input[name="Content-Type"]').val(file.type);
                        form.find('input[name="key"]').val((folders.length ? folders.join('/') + '/' : '') + filename);

                        // Show warning message if your leaving the page during an upload.
                        window.onbeforeunload = function () {
                            return 'You have unsaved changes.';
                        };      
                        

                        $('#label_file').empty();
                		
                		// Actually submit to form to S3.
                        data.submit();

                        // Show the progress bar
                        // Uses the file size as a unique identifier
                        var bar = $('<div class="progress" data-mod="'+file.size+'"><div class="bar"></div></div>');
                        $('.progress-bar-area').append(bar);
                        bar.slideDown('fast');

                        // Hidde the input file, one at a time
                        form.find('input[name="file"]').hide();



                        

                        
                        //console.log(loadImage(file));
                                      

                        /*
                        if ("<?php //echo $_POST['adulto']; ?>" == "1")  // Para adultos
                        {
                        	if (size >= 1024*1024*6 && size <= 1024*1024*10 && type == 'image/jpeg')
                        	{
                        		$('#label_file').empty();
                        		
                        		// Actually submit to form to S3.
                                data.submit();

                                // Show the progress bar
                                // Uses the file size as a unique identifier
                                var bar = $('<div class="progress" data-mod="'+file.size+'"><div class="bar"></div></div>');
                                $('.progress-bar-area').append(bar);
                                bar.slideDown('fast');

                                // Hidde the input file, one at a time
                                form.find('input[name="file"]').hide();
                        	}		

                            else {
                                $('#label_file').empty().html('La fotografía debe de ser .jpg y debe pesar por lo menos 6MB y máximo 10 MB');
                                return false;
                            }    

                        } else {  // Para jovenes
                        	if (size <= 1024*1024*10 && type == 'image/jpeg')
                        	{
                        		$('#label_file').empty();
                        		// Actually submit to form to S3.
                                data.submit();

                                // Show the progress bar
                                // Uses the file size as a unique identifier
                                var bar = $('<div class="progress" data-mod="'+file.size+'"><div class="bar"></div></div>');
                                $('.progress-bar-area').append(bar);
                                bar.slideDown('fast');

                                // Hidde the input file, one at a time
                                form.find('input[name="file"]').hide();
                        	}	

                        	else {
                            	$('#label_file').empty().html('La fotografía debe de ser .jpg y debe pesar por lo menos 6MB y máximo 10 MB');
                                return false;
                            }   
                        } 

                        if (res.is_valid)
                        {
                        	$('#label_file').empty();
                    		// Actually submit to form to S3.
                            data.submit();

                            // Show the progress bar
                            // Uses the file size as a unique identifier
                            var bar = $('<div class="progress" data-mod="'+file.size+'"><div class="bar"></div></div>');
                            $('.progress-bar-area').append(bar);
                            bar.slideDown('fast');

                            // Hidde the input file, one at a time
                            form.find('input[name="file"]').hide();
                            
                        } else {
                        	$('#label_file').empty().html(res.error);
                            return false;   
                        }       */                           
                    },
                    progress: function (e, data) {
                        // This is what makes everything really cool, thanks to that callback
                        // you can now update the progress bar based on the upload progress.
                        var percent = Math.round((data.loaded / data.total) * 100);
                        $('.progress[data-mod="'+data.files[0].size+'"] .bar').css('width', percent + '%').html(percent+'%');
                    },
                    fail: function (e, data) {
                        // Remove the 'unsaved changes' message.
                        window.onbeforeunload = null;
                        $('.progress[data-mod="'+data.files[0].size+'"] .bar').css('width', '100%').addClass('red').html('');
                        form.find('input[name="file"]').show();
                    },
                    done: function (event, data) {
                        window.onbeforeunload = null;

                        // Upload Complete, show information about the upload in a textarea
                        // from here you can do what you want as the file is on S3
                        // e.g. save reference to your server / log it, etc.
                        var original = data.files[0];
                        var s3Result = data.result.documentElement.children;

                        var filesUploaded = {
                            "original_name": original.name,
                            "s3_name": s3Result[2].innerHTML,
                            "size": original.size,
                            "url": s3Result[0].innerHTML,
                            "type": original.type
                        };

                        $.ajax({
                        	  method: "POST",
                        	  url: "<?php echo Yii::app()->request->baseUrl; ?>" + "/index.php/fotos/formulario_fotos",
                        	  data: {categoria_id: "<?php echo $categoria_id; ?>", ruta: filesUploaded.url, nombre_original: filesUploaded.original_name,
                            	  nombre: filesUploaded.s3_name, size: filesUploaded.size, type: filesUploaded.type}
                        	}).done(function( html ) {
                            	$('#formulario_fotos').append(html);
                        	  });
                    }
                });  // cierra fileupload
            });
        </script>
