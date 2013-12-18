
    <div id="main-content">
        {error_message}
        <div class="row-fluid">

            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i>{pageContentHeader} {pageContent}</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-vertical" id="{pageContent}" action="{site_url}admin/{pageContentLink}/action_config" enctype="multipart/form-data" method="post" >
                        <div style="padding: 10px" align="right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <!--  <button class="btn" type="reset">Clear Fields</button>-->
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                MAIN TITLE
                                <span class="required">*</span>
                            </label>
                            <div class="controls">
                                <input class="span12" value="{main_title}" type="text" name="main_title">
                            </div>
                        </div>

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
                            <label class="control-label" for="input01">Main Category</label>
                            <div class="controls">
                                <select id="input01" name="mcat_id[]" class="span12">
                                    <option value="0">-- Pick A Category --</option>
                                    {catValue0}
                                    <option  value="{catid}" {selected}>{nameP} >> {nameC}</option>
                                    {/catValue0}
                                </select>
                            </div>


                            <div class="controls">
                                <select id="input01" name="mcat_id[]" class="span12">
                                    <option value="0">-- Pick A Category --</option>
                                    {catValue1}
                                    <option  value="{catid}" {selected}>{nameP} >> {nameC}</option>
                                    {/catValue1}
                                </select>
                            </div>

                            <div class="controls">
                                <select id="input01" name="mcat_id[]" class="span12">
                                    <option value="0">-- Pick A Category --</option>
                                    {catValue2}
                                    <option  value="{catid}" {selected}>{nameP} >> {nameC}</option>
                                    {/catValue2}
                                </select>
                            </div>

                        </div>
                        <div class="control-group">
                            <label class="control-label">Store Description</label>
                            <div class="controls">
                                <textarea id="main_desc" name="main_desc">{main_desc}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Store Address</label>
                            <div class="controls">
                                <textarea id="main_add" name="main_add">{main_add}</textarea>
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
    </div>