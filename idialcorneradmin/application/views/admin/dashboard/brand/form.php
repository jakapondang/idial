    <div id="main-content">
        {error_message}
        <div class="row-fluid">

            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i>{pageContentHeader} {pageContent}</span>
                </div>
                <div class="widget-content form-container">
                  <form class="form-vertical" id="{pageContent}" action="{site_url}admin/{pageContentLink}/action" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="{id}">
                      <div style="padding: 10px" align="right">
                          <button type="submit" class="btn btn-primary">Save</button>
                          <!--  <button class="btn" type="reset">Clear Fields</button>-->
                      </div>
                        <div class="control-group">
                            <label class="control-label">
                                Name
                                <span class="required">*</span>
                            </label>
                                <div class="controls">
                                    <input class="span12" value="{name}" onchange="return cekName(this.value)" id="name" type="text" name="name">
                                </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" {status} name="status" value="1" data-provide="ibutton">
                                </label>
                             </div>
                         </div>


                        <div class="control-group">
                            <label class="control-label">Short Description</label>
                            <div class="controls">
                                <textarea id="sdesc" name="sdesc">{sdesc}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Description</label>
                            <div class="controls">
                                <textarea id="desc" name="desc">{desc}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input04">Preview Logo</label>
                            <div class="controls">
                               <img src="{imageLink}{pageContentLink}/{imgName}">

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input04">Upload Logo</label>
                            <div class="controls">
                                <input type="file" name="userfile" id="userfile" data-provide="fileinput">
                                <p class="help-block"><code>Format Logo : jpg , png , gif.</code></p>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button>
                          <!--  <button class="btn" type="reset">Clear Fields</button>-->
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
</div>
</div>
</div>
</div>
    <script>
        function cekName(valueName){

            if(valueName!=""){
                var inputName = document.getElementById('name');
                $.post( "<?php print base_url()?>admin/brand/postcekName", { name: valueName })
                    .done(function( data ) {
                        if(data>0){
                            inputName.value = "";
                        }else{
                            //uri_name
                            if (valueName) {
                                var valueName = valueName.toLowerCase();
                                var valueName = valueName.split(' ').join('-');
                                document.getElementById('uri_name').value =valueName ;
                            }

                        }
                    });
            }



        }
    </script>