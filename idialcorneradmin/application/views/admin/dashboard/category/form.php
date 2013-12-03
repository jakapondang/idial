    <div id="main-content">

        <div class="row-fluid">

            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i>{pageContentHeader} {pageContent}</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-vertical" id="{pageContent}" action="{site_url}admin/{pageContentLink}/action" method="post" novalidate="novalidate">
                       <div class="control-group">
                             <label class="control-label" for="input01">Parent {pageContent}</label>
                             <div class="controls">
                                 <select id="input01" name="parent_id" class="span12">
                                     <option value="0">No Parent</option>

                                 {parentValue}
                                     <option  value="{cat_id}" {selected}>{name}</option>
                                 {/parentValue}
                                 </select>
                             </div>
                         </div> <!-- -->
                        <input type="hidden" name="id" value="{id}">
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