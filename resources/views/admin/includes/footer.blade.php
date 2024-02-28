            <footer class="footer ">
                <div class="container-fluid clearfix ">
                    <span class="d-block text-center  text-light">Copyright © MasterCode.com</span>
                </div>
            </footer>
        </div>
    </div>
</div>
{{-- <script src="{{asset('admin_files')}}//js/index_mai.js "></script>
<script src="{{asset('admin_files')}}//js/file-upload.js"></script>
<script>
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script> --}}
<script src="{{asset('admin_files')}}/js/vendor.bundle.base.js"></script>
<script src="{{asset('admin_files')}}/js/off-canvas.js"></script>
<script src="{{asset('admin_files')}}/js/hoverable-collapse.js "></script>
<script src="{{asset('admin_files')}}/js/misc.js "></script>
@stack('scripts')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatableid').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            }
        });
    } );
</script>
<script>
    $(document).ready(function(){
    $('.toast').toast('show');
    });
</script>
</body>
</html>
