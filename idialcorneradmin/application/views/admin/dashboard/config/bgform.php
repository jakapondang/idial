
    <div id="main-content">
        {error_message}
        <div class="row-fluid">

            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i>{pageContentHeader} {pageContent}</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-vertical" id="{pageContent}" action="{site_url}admin/{pageContentLink}/action_background" enctype="multipart/form-data" method="post" >

                        <div style="padding: 10px" align="right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <!--  <button class="btn" type="reset">Clear Fields</button>-->
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="cp1">HEADER MENU BACKGROUND</label>
                            <div class="controls">
                                <input id="cp1" type="text" name="hm_background" class="minicolors" value="{hm_background}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cp1">BEFORE FOOTER BACKGROUND</label>
                            <div class="controls">
                                <input id="cp1" type="text" name="bf_background" class="minicolors" value="{bf_background}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cp1">FOOTER BACKGROUND</label>
                            <div class="controls">
                                <input id="cp1" type="text" name="fo_background" class="minicolors" value="{fo_background}">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>