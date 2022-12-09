<!DOCTYPE html>
<html>
<head>
  <title>New Member Registration</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $( document ).ready(function() {
      give_focus()
    });
    function give_focus() {
      $('#tag').focus()
    }
    function inquiry() {
      var tag = $('#tag').val()
      request_data(tag)
      $('#tag').val('')
      $('#tag').focus()
    }
    function request_data(tag) {
      $.ajax({
        type: "GET",
        url: "inquiry.php?tag=" + tag,
        success: function(data) {
          var res = $.parseJSON(data)
          if (res.response == 200) {
            swal.fire({
              icon: res.class,
              title: res.title,
              html: res.text,
          //     footer:''
          //     +' Nama : '+ $json['nama']
          // <br> NIK : '.$json['nik'].'
          // <br> alamat : '.$json['alamat'].''
          //     +'',
            })
          }else{

            Swal.fire({
              icon: res.class,
              title: res.title,
              html: res.text,
            })
          }

        },
        error: function(error) {
        },
      });
    }
  </script>
  <style>
    body{
      overflow-y: hidden;
    }
    .banner {
      position: relative;
      /*height: 300px;*/
      height: 250px;
      background-image: url("bg.jpg");  
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
  </style>
</head>
<body onclick="give_focus()">
  <div class="card mb-5">
    <div class="banner">
    </div>
    <div class="mt-5">
      <center>
        <img src="rfid-icon.png" width="300px" style="position: relative; margin-top: 20px; margin-bottom: 20px;">
        <h2 style="margin-top: 20px; margin-bottom: 20px;">Mohon scan E-KTP pada alat dibawah</h2>
      </center>
    </div>
  </div>
  <center>

    <input type="text" id="tag" name="tag" onchange="inquiry()">
  </center>
</body>
</html>