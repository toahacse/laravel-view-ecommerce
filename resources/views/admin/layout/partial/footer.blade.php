<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr/>
        <h6 class="mb-0">Theme Styles</h6>
        <hr/>
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                <label class="form-check-label" for="lightmode">Light</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                <label class="form-check-label" for="darkmode">Dark</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                <label class="form-check-label" for="semidark">Semi Dark</label>
            </div>
        </div>
        <hr/>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
        </div>
        <hr/>
        <h6 class="mb-0">Header Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
            </div>
        </div>
        <hr/>
        <h6 class="mb-0">Sidebar Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{asset('assets/js/index.js')}}"></script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('snackbar/dist/js-snackbar.js')}}"></script>

<script src="https://developercodez.com/developerCorner/parsley/parsley.min.js"></script>

<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#formSubmit').on('submit', (function(e){
            e.preventDefault();
            if($(this).parsley().validate()){
                const formData = new FormData(this);
                const html='<button class="btn btn-primary" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>';
                const html1='<input type="submit" id="submitButton" class="btn btn-primary px-4"/>';
                $('#submitButton').html(html);
                $.ajax({
                    type: 'POST',
                    url : $(this).attr('action'),
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function(result){
                        if(result.status == 'success'){
                            showAlert(result.status, result.message)
                            $('#submitButton').html(html1);

                            if(result.data.reload != undefined){
                                window.location.href = window.location.href;
                            }
                        }else{
                            showAlert(result.status, result.message)
                            $('#submitButton').html(html1);
                        }
                    },
                    error: function(result){
                        showAlert(result.responseJSON.status, result.responseJSON.message)
                        $('#submitButton').html(html1);
                    }
                });
            }
        }));

    });
</script>

<script>
    function deleteData(id, table){
        let text = "Are you sure want do delete";
        if (confirm(text) == true) {
            $.ajax({
                type: 'GET',
                url : "{{ url('admin/deleteData') }}/"+id+"/"+table+"",
                data:'',
                cache:false,
                contentType:false,
                processData:false,
                success:function(result){
                    console.log(result);
                    
                    if(result.status == 'success'){
                        showAlert(result.status, result.message)
                        if(result.data.reload != undefined){
                            window.location.href = window.location.href;
                        }
                    }else{
                        showAlert(result.status, result.message)
                    }
                },
                error: function(result){
                    showAlert(result.responseJSON.status, result.responseJSON.message)
                }
            });
        } else {
        
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
      } );
</script>

<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );
</script>


<script>
    function showAlert(status, message){
        SnackBar({
            status: status,
            message: message,
            position: 'br'
        });
    }
</script>

<script>
    $("#photo").on('change', function(event) {
        const input = event.target;
        const reader = new FileReader();
        
        reader.onload = function(){
            $('#imgPreview').attr('src', reader.result);
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>