
    <div id="main-content">
        {error_message}
        <div class="row-fluid">

            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i>{pageContentHeader} {pageContent}</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-vertical" id="{pageContent}" action="{site_url}admin/{pageContentLink}/action" enctype="multipart/form-data" method="post" >


                        <div class="control-group">
                            <label class="control-label">
                                MAIN EMAIL
                                <span class="required">*</span>
                            </label>
                            <div class="controls">
                                <input class="span12" value="{main_email}" type="text" name="main_email">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cp1">HEADER MENU BACKGROUND</label>
                            <div class="controls">
                                <input id="cp1" type="text" name="header_menu_background" class="minicolors" value="{header_menu_background}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cp1">BODY BACKGROUND</label>
                            <div class="controls">
                                <input id="cp1" type="text" name="body_background" class="minicolors" value="{body_background}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cp1">FOOTER BACKGROUND</label>
                            <div class="controls">
                                <input id="cp1" type="text" name="footer_background" class="minicolors" value="{footer_background}">
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