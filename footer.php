    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <a href="http://iitk.ac.in/smartcity/team.php" target="_blank">SmartCity Team</a>
        </div>
        <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">Power System Lab, IIT Kanpur</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<!--<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>-->
<!-- jQuery 3.1.1 -->
<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- DataTables -->
<!--<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>-->
<script src="plugins/DataTables-1.10.13/media/js/jquery.dataTables.min.js"></script>
<!--<script src="plugins/datatables/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>-->
<script src="plugins/DataTables-1.10.13/media/js/dataTables.bootstrap.min.js"></script>
<!--<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>-->
<script src="plugins/DataTablesResponsive-2.1.1/js/dataTables.responsive.min.js"></script>

<!-- https://notifyjs.com/ -->
<script src="plugins/notify/notify.min.js"></script>
<!-- <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>-->

<!-- jQuery Validation JavaScript -->
<script src="plugins/jqvalidate/jquery.validate.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>-->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<!-- <script src="bower_components/PACE/pace.min.js"></script> -->

<script src="dist/js/custom.js"></script>

<script>
// $(document).ajaxStart(function() { Pace.restart(); }); 
</script>
    
<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        var $dtl = $('#dataTables-list');-->
<!--        $dtl.DataTable({-->
<!--            responsive: true,-->
<!--            searching: true,-->
<!--            details: true,-->
<!--            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],-->
<!--            language: {-->
<!--                searchPlaceholder: "Search Anything"-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->

<?php
if (Session::exists('fmsg')) {
    $flash_message = Session::flash('fmsg');
    $flash_class =  (Session::exists('fclass')) ? Session::flash('fclass') : 'success';
    echo "<script>$.notify(\"$flash_message\", { position:'top center', style:'bootstrap', className:\"$flash_class\" });</script>";
}
?>
</body>
</html>
