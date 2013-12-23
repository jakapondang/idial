<footer id="footer">
    <div class="footer-left">iDial Corner.com - CMS</div>
    <div class="footer-right"><p>Copyright 2013 JP. All Rights Reserved.</p></div>
</footer>

</div>

<script>
    // var datatable
    var site_url="{site_url}";
    var urlActionTable = site_url+"{urlActionTable}";
    var urlEditRow = site_url+"{urlEditRow}";
    var urlDelRow = site_url+"{urlDelRow}";
    var tableFormName = "{tableFormName}";
    var tableType = "{tableType}";
    if(tableType=="action"){
        var colEnd =parseInt("{colEnd}");
    }
    function DeleteConfirm(iDData){
        var r=confirm("Are you sure , you want to DELETE ID "+iDData+" ?");

    }
    function CancelConfirm(iDData){
        var r=confirm("Are you sure , you want to Cancel Order ID "+iDData+" ?");

    }
    function ApproveConfirm(iDData){
        var r=confirm("Are you sure , you want to Approve ID "+iDData+" ?");

    }
</script>
    <!-- Core Scripts -->
<script src="{base_url}js/libs/jquery-1.8.3.min.js"></script>
<script src="{base_url}bootstrap/js/bootstrap.min.js"></script>
<script src="{base_url}js/libs/jquery.placeholder.min.js"></script>
<script src="{base_url}js/libs/jquery.mousewheel.min.js"></script>

<!-- Template Script -->
<script src="{base_url}js/template.js"></script>
<script src="{base_url}js/setup.js"></script>

<!-- Customizer, remove if not needed -->
<script src="{base_url}js/customizer.js"></script>

<!-- Uniform Script -->
<script src="{base_url}plugins/uniform/jquery.uniform.min.js"></script>

<!-- jquery-ui Scripts -->
<script src="{base_url}jui/js/jquery-ui-1.9.2.min.js"></script>
<script src="{base_url}jui/jquery-ui.custom.min.js"></script>
<script src="{base_url}jui/timepicker/jquery-ui-timepicker.min.js"></script>
<script src="{base_url}jui/jquery.ui.touch-punch.min.js"></script>

<!-- Plugin Scripts -->

<!-- DataTables -->
<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/TableTools/js/TableTools.min.js"></script>
<script src="{base_url}plugins/datatables/FixedColumns/FixedColumns.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.js"></script>
<script src="{base_url}plugins/datatables/jquery.dataTables.columnFilter.js"></script>

<!-- Demo Scripts -->
<script src="{base_url}adminjs/dataTables.js"></script>

</body>

</html>