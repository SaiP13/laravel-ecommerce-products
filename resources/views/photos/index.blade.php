<!DOCTYPE html>
<html>
<head>
  <title>Photos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <style>
    .preview-image img
    {
          padding: 10px;
          max-width: 100px;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card">
    <div class="card-body">
        <form id="fileUpload" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
          @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="images" name="images[]" multiple="" required>
                          <label class="custom-file-label" for="inputGroupFile01">Choose Multiple Images</label>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mt-1 text-center">
                        <div class="preview-image"> </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

  </div>
  <br>
  <div class="card">
        <div class="card-header text-center font-weight-bold">
        <h2>Photos</h2>
      </div>
      <div class="card-body">
        <div class="row">
            <div id="ajax_result">

            </div>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">

$(document).ready(function (e) {
    ajax_call();
   function ajax_call(){
        $.ajax({
        url : "{{ url('getimages')}}",
        type : "get",
        success: function(data){
            $('#ajax_result').html(data);
        }

    });
    }

   $('#fileUpload').submit(function(e) {
    e.preventDefault();
      var formData = new FormData(this);
      let TotalImages = $('#images')[0].files.length; //Total Images
      let images = $('#images')[0];

      for (let i = 0; i < TotalImages; i++) {
          formData.append('images' + i, images.files[i]);
      }
      formData.append('TotalImages', TotalImages);

     $.ajax({
        type:'POST',
        url: "{{ url('imageUpload')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           this.reset();
           alert('Successfully Uploaded');
           ajax_call();
        },
        error: function(data){
           console.log(data);
         }
       });
   });
});
</script>
</body>
</html>
