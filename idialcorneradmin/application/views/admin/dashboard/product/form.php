
<div id="main-content">
    {error_message}
    <div class="row-fluid">

        <div class="span12 widget">
            <div class="widget-header">
                <span class="title"><i class="icon-edit"></i>{pageContentHeader} {pageContent}</span>
                <div class="toolbar">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#tab-01" data-toggle="tab">GENERAL</a></li>
                        <li><a href="#tab-02" data-toggle="tab">PRICE</a></li>
                        <li><a href="#tab-03" data-toggle="tab">IMAGE</a></li>
                    </ul>
                </div>
            </div>

               <form class="form-vertical" id="{pageContent}" action="{site_url}admin/{pageContentLink}/action" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="{id}">
                   <div class="tab-content">
                       <div class="tab-pane active" id="tab-01">
                           <div class="widget-content form-container">
                               <div class="control-group">
                                   <label class="control-label">
                                       Name
                                       <span class="required">*</span>
                                   </label>
                                   <div class="controls">
                                       <input class="span12" value="{name}" type="text" name="name">
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label">
                                       SKU
                                       <span class="required">*</span>
                                   </label>
                                   <div class="controls">
                                       <input class="span12" value="{sku}" type="text" name="sku">
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label" for="input01">Parent {pageContent}</label>
                                   <div class="controls">
                                       <select id="input01" name="bra_id" class="span12">
                                           <option value="0">-- Pick A Brand --</option>
                                           {brandValue}
                                           <option  value="{braid}" {selected}>{nameB}</option>
                                           {/brandValue}
                                       </select>
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
                            </div>
                       </div>
                       <div class="tab-pane" id="tab-02">
                           <div class="widget-content form-container">
                               <div class="control-group">
                                   <label class="control-label">
                                       NETT
                                       <span class="required">*</span>
                                   </label>
                                   <div class="controls">
                                       <input class="span12" value="{nett}" type="text" name="nett">
                                       <p class="help-block"><code>Format : Number Only.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label">
                                       GROSS
                                       <span class="required">*</span>
                                   </label>
                                   <div class="controls">
                                       <input class="span12" value="{gross}" type="text" name="gross">
                                       <p class="help-block"><code>Format : Number Only.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label">
                                       DISCOUNT
                                       <span class="required">*</span>
                                   </label>
                                   <div class="controls">
                                       <input class="span12" value="{discount}" type="text" name="discount">
                                       <p class="help-block"><code>Format : Number Only.</code></p>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="tab-pane" id="tab-03">
                           <div class="widget-content form-container">
                               <div class="control-group">
                                   <label class="control-label" for="input04">Image 1</label>
                                   <div class="controls">
                                       <input type="file" name="userfile[]" id="imgProduct" data-provide="fileinput">
                                       <p class="help-block"><code>Format Logo : jpg , png , gif.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label" for="input04">Image 2</label>
                                   <div class="controls">
                                       <input type="file" name="userfile[]" id="imgProduct" data-provide="fileinput">
                                       <p class="help-block"><code>Format Logo : jpg , png , gif.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label" for="input04">Image 3</label>
                                   <div class="controls">
                                       <input type="file" name="userfile[]" id="imgProduct" data-provide="fileinput">
                                       <p class="help-block"><code>Format Logo : jpg , png , gif.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label" for="input04">Image 4</label>
                                   <div class="controls">
                                       <input type="file" name="userfile[]" id="imgProduct" data-provide="fileinput">
                                       <p class="help-block"><code>Format Logo : jpg , png , gif.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label" for="input04">Image 5</label>
                                   <div class="controls">
                                       <input type="file" name="userfile[]" id="imgProduct" data-provide="fileinput">
                                       <p class="help-block"><code>Format Logo : jpg , png , gif.</code></p>
                                   </div>
                               </div>
                               <div class="control-group">
                                   <label class="control-label" for="input04">Preview Logo</label>

                                   {imagePreview}

                               </div>
                           </div>
                       </div>
                       <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <!--  <button class="btn" type="reset">Clear Fields</button>-->
                        </div>
                   </div>
               </form>

        </div>

    </div>
</div>
</section>
</div>
</div>
</div>
