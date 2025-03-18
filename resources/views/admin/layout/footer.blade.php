<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y');?> <a href="{{url('/admin/dashboard')}}">Car Bike</a></strong>
    All rights reserved. | Designed and Developed by Shivam.

</footer>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>


<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
$.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>

<script src="{{asset('backend/plugins/sparklines/sparkline.js')}}"></script>

<script src="{{asset('backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<script src="{{asset('backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>

<script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script src="{{asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
{{-- <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script> --}}
{{-- <script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script> --}}
{{-- <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script> --}}
{{-- <script src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script> --}}
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

<script src="{{asset('backend/js/adminlte2167.js')}}?v=3.2.0"></script>

<script src="{{asset('backend/js/demo.js')}}"></script>

<script src="{{asset('backend/js/pages/dashboard.js')}}"></script>


<script>
    // {{-- // Display success message --}}
@if(session('success'))
    toastr.success('{{ session('success') }}');
@endif

// {{-- // Display error message --}}
@if(session('error'))
    toastr.error('{{ session('error') }}');
@endif
@if(session('info'))
    toastr.info('{{ session('info') }}');
@endif


$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
//   $('.select2bs4').select2({
//     theme: 'bootstrap4'
//   })

  })
</script>
</body>


</html>
