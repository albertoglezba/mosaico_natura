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
};


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
    $scope = array(
        Yii::app()->params['aws_access_key'],
        $shortDate,
        $region,
        $service,
        $requestType
    );
    $credentials = implode('/', $scope);

    // Step 2: Making a Base64 Policy
    $policy = array(
        'expiration' => gmdate('Y-m-d\TG:i:s\Z', strtotime('+6 hours')),
        'conditions' => array(
            array('bucket' => $s3Bucket),
            array('acl' => $acl),
            array('starts-with', '$key', ''),
            array('starts-with', '$Content-Type', ''),
            array('success_action_status' => $successStatus),
            array('x-amz-credential' => $credentials),
            array('x-amz-algorithm' => $algorithm),
            array('x-amz-date' => $date),
            array('x-amz-expires' => $expires),
        )
    );
    $base64Policy = base64_encode(json_encode($policy));

    // Step 3: Signing your Request (Making a Signature)
    $dateKey = hash_hmac('sha256', $shortDate, 'AWS4' . Yii::app()->params['aws_secret'], true);
    $dateRegionKey = hash_hmac('sha256', $region, $dateKey, true);
    $dateRegionServiceKey = hash_hmac('sha256', $service, $dateRegionKey, true);
    $signingKey = hash_hmac('sha256', $requestType, $dateRegionServiceKey, true);

    $signature = hash_hmac('sha256', $base64Policy, $signingKey);

    // Step 4: Build form inputs
    // This is the data that will get sent with the form to S3
    $inputs = array(
        'Content-Type' => '',
        'acl' => $acl,
        'success_action_status' => $successStatus,
        'policy' => $base64Policy,
        'X-amz-credential' => $credentials,
        'X-amz-algorithm' => $algorithm,
        'X-amz-date' => $date,
        'X-amz-expires' => $expires,
        'X-amz-signature' => $signature
    );

    return compact('url', 'inputs');
}

?>
<div class="container">

<h4><em>Primer paso</em>, sube un video con extensión .mov o .mpg y con peso mínimo de 19 MB y máximo de 5 GB</h4>
(Recuerda que una vez procesado el video no se permiten hacer cambios)

    <!-- Direct Upload to S3 Form -->
    <form action="<?php echo $s3FormDetails['url']; ?>"
          method="POST"
          enctype="multipart/form-data"
          class="direct-upload">

        <?php foreach ($s3FormDetails['inputs'] as $name => $value) { ?>
            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
        <?php } ?>

        <!-- Key is the file's name on S3 and will be filled in with JS -->
        <input type="hidden" name="key" value="">
        <div id="label_file" class="alert alert-warning hidden" role="alert"></div>
        <div class="fileUpload btn btn-success">
            <span>Sube tu video</span>
            <input type="file" name="file" id="file_to_upload" class="upload">
        </div>

        <!-- Progress Bars to show upload completion percentage -->
        <div class="progress-bar-area"></div>

    </form>

    <div id="formulario_fotos"></div>

</div>
<script>
    $(document).ready(function () {
        // Assigned to variable for later use.
        var form = $('.direct-upload');

        // Place any uploads within the descending folders
        var folders = ["<?php echo $material; ?>"];

        form.fileupload({
            url: form.attr('action'),
            type: form.attr('method'),
            datatype: 'xml',
            add: function (event, data) {

                // Give the file which is being uploaded it's current content-type (It doesn't retain it otherwise)
                // and give it a unique name (so it won't overwrite anything already on s3).

                var file = data.files[0];
                var filename = "<?php echo $fecha.$usuario; ?>" + '.' + file.name.split('.').pop();
                
                var toAWS = function() {
                    $('#label_file').empty();
                    $('#label_file').removeClass('hidden');
                    $('#label_file').removeClass('alert-warning');
                    $('#label_file').addClass('alert-info');
                    $('#label_file').html('Tu archivo cumple con los requisitos, por favor espera a que termine la carga');
                    $('.fileUpload').hide();
                    // Actually submit to form to S3.
                    data.submit();

                    // Show the progress bar
                    // Uses the file size as a unique identifier
                    var bar = $('<div class="progress" data-mod="'+file.size+'"><div class="bar"></div></div>');
                    $('.progress-bar-area').append(bar);
                    bar.slideDown('fast');

                    // Hide the input file, one at a time
                    form.find('input[name="file"]').hide();
                };
                
                form.find('input[name="Content-Type"]').val(file.type);
                form.find('input[name="key"]').val((folders.length ? folders.join('/') + '/' : '') + filename);

                // Show warning message if your leaving the page during an upload.
                window.onbeforeunload = function () {
                    return 'You have unsaved changes.';
                };

                // Para la duracion del video
                var video = document.createElement('video');
                video.preload = 'metadata';
                video.onloadedmetadata = function() {
                  file.duration = video.duration;  

               // Requisitos del video                
  				if (file.type == 'video/quicktime' || file.type == 'video/mpeg')
  				{
  					if (file.size >= 1024*1024*19 && file.size <= 1024*1024*1024*5)
  					{
  						if (file.duration >= 60 && file.duration <= 120)
  						{
  							toAWS();
  						} else {
  							$('#label_file').removeClass('hidden').empty().html('La duración debe ser entre 60 y 120 segundos.');
  							return false;
  						}	
  						
  					} else {
  						$('#label_file').removeClass('hidden').empty().html('El peso límite del video debe ser mínimo 19 MB y máximo 5 GB.');
  						return false;
  					}
  						
  				} else {
  					$('#label_file').removeClass('hidden').empty().html('Solo se admiten extensiones .mov y .mpg');
  					return false;
  				}

  				          
                }  //Cierra onloadmetadata
                video.src = URL.createObjectURL(file);
				
                                                        
             	            
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
                var url = $(data.result.documentElement).children().contents()[0].textContent;
                var s3_name = $(data.result.documentElement).children().contents()[2].textContent;

                var filesUploaded = {
                    "original_name": original.name,
                    "s3_name": s3_name,
                    "size": original.size,
                    "url": url,
                    "type": original.type
                };
                $.ajax({
                    method: "POST",
                    url: "<?php echo Yii::app()->request->baseUrl; ?>" + "/index.php/videos/formulario_videos",
                    data: {ruta: filesUploaded.url, nombre_original: filesUploaded.original_name,
                        nombre: filesUploaded.s3_name, size: filesUploaded.size, type: filesUploaded.type}
                }).done(function( html ) {
                    $('#formulario_completo').append(html);
                });
            }
        });  // cierra fileupload
    });
</script>

<div id='formulario_completo'></div>