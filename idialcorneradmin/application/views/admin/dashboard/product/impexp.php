
<div id="main-content">
{error_message}

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-progress-bar"></i>Import Product file CSV</span>
                </div>

                <div class="widget-content form-container">


                    <form class="form-horizontal" method="post" id="{pageContentLink}" action="{site_url}admin/{pageContentLink}/action_import" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label">
                                Browse your .csv
                            </label>
                            <div class="controls">

                                <input type="file" name="userfile" id="impProduct" data-provide="fileinput">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                           <!-- <div class="controls">
                                <div class="progress active progress-striped">
                                    <div class="bar" style="width: 67%; ">67%</div>
                                </div>

                            </div>-->
                            <div class="controls">
                                <p><span style="color:red">Format must be : .csv</span></p>
                            </div>
                            <div class="controls">

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


<!--

    <div class="row-fluid">

        <div class="span12">


            <div class="widget">
                <div class="widget-header">
                    <span class="title">Import</span>
                    <div class="toolbar">
                        <div class="progress progress-striped progress-success active">
                            <div class="bar" style="width: 83%; ">83%</div>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <h4>Import Product file CSV</h4>
                    <p>Browse your file CSV files . Format must be : .csv</p>
                    <!--<p><code>&lt;div class=&quot;progress&quot; style=&quot;width: 200px; &quot;&gt;&lt;/div&gt;</code></p>
                    <form method="post">
                        <input type="file" name="import" id="import">
                    </form>
                </div>
            </div>


        </div>

    </div>-->


</div>
</section>
</div>
</div>
</div>

