<div class="row-fluid">
    <div class="span12">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-accept"></i> Validation Example 3
                </span>
            </div>
            <div class="da-panel-content da-form-container">
                <form id="da-ex-validate3" class="da-form">
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label class="da-form-label">Radio Button <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                    <li><input type="radio" name="gender"> <label>Male</label></li>
                                    <li><input type="radio" name="gender"> <label>Female</label></li>
                                </ul>
                                <label for="gender" class="error" generated="true" style="display:none;"></label>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Checkbox <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                    <li><input type="checkbox" name="sport"> <label>Soccer</label></li>
                                    <li><input type="checkbox" name="sport"> <label>Badminton</label></li>
                                    <li><input type="checkbox" name="sport"> <label>Tennis</label></li>
                                </ul>
                                <label for="sport" class="error" generated="true" style="display:none;"></label>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">File <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="file" name="file1" class="da-custom-file">
                                <label for="file1" class="error" generated="true" style="display:none;"></label>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Dropdown <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <select name="dd1" class="span12">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Dropdown with Select2 <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <select id="da-ex-val-chzn" name="chosen1" class="span12">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                <label for="da-ex-val-chzn" generated="true" class="error" style="display:none;"></label>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Spinner</label>
                            <div class="da-form-item large">
                                <input id="da-ex-val-spin" type="text" name="spin1" value="3" class="span12">
                                <label for="da-ex-val-spin" generated="true" class="error" style="display:none;"></label>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <input type="submit" value="Validate Me" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>                        	
</div>