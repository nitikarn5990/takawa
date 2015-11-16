<div class="row-fluid">
    <div class="span9">
        <ul class="da-stats-container">
            <li data-provide="circular" data-fill-color="#a6d037" data-initial-value="55" data-max-value="98" data-label="Seeds Collected" style="width: 136px; height: 136px;"></li>
            <li data-provide="circular" data-fill-color="#ea799b" daa-percent="true" data-initial-value="200" data-max-value="241" data-label="iPads Cloned" style="width: 136px; height: 136px;"></li>
            <li data-provide="circular" data-fill-color="#fab241" data-initial-value="124" data-max-value="523" data-label="Androids Bought" style="width: 136px; height: 136px;"></li>
            <li data-provide="circular" data-fill-color="#61a5e4" data-percent="true" data-initial-value="42" data-max-value="100" data-label="Funds Collected" style="width: 136px; height: 136px;"></li>
        </ul>
    </div>
</div>

<div class="row-fluid">
    <div class="span9">
        <div class="da-panel">
            <div class="da-panel-content">
                <h3>Statement for June 2012</h3>
                <div id="da-ex-flot" style="height: 384px;"></div>
            </div>
        </div>
    </div>
    <div class="span3">
        <div class="da-panel">
            <div class="da-panel-content">
                <h3>Summary</h3>
                <ul class="da-summary-stat">
                    <li>
                        <a href="#">
                            <span class="da-summary-icon" style="background-color:#e15656;">
                                <i class="icon-truck"></i>
                            </span>
                            <span class="da-summary-text">
                                <span class="value up">211</span>
                                <span class="text">Packages Distributed</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="da-summary-icon" style="background-color:#a6d037;">
                                <i class="icon-t-shirt"></i>
                            </span>
                            <span class="da-summary-text">
                                <span class="value">512</span>
                                <span class="text">T-Shirts Sold</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="da-summary-icon" style="background-color:#ea799b;">
                                <i class="icon-bank"></i>
                            </span>
                            <span class="da-summary-text">
                                <span class="value up">286</span>
                                <span class="text">Transactions Completed</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="da-summary-icon" style="background-color:#fab241;">
                                <i class="icon-airplane"></i>
                            </span>
                            <span class="da-summary-text">
                                <span class="value down">61</span>
                                <span class="text">Planes Flown</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="da-summary-icon" style="background-color:#61a5e4;">
                                <i class="icon-birthday-cake"></i>
                            </span>
                            <span class="da-summary-text">
                                <span class="value">42</span>
                                <span class="text">Cakes Baked</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="da-summary-icon" style="background-color:#656565;">
                                <i class="icon-parents"></i>
                            </span>
                            <span class="da-summary-text">
                                <span class="value">266</span>
                                <span class="text">Customers Satisfied</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span6">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icon-magic"></i>
                    Wizard Form
                </span>

            </div>
            <div class="da-panel-content da-form-container">
                <form id="da-ex-wizard-form" class="da-form" method="post" action="wizard.php">
                    <fieldset class="da-form-inline">
                        <legend data-icon="icon-edit">Account</legend>
                        <div class="da-form-row">
                            <label class="da-form-label">Username <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="wizard[username]" class="required span12">
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Email <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="wizard[email]" class="required email span12">
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Password <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="password" name="wizard[password]" class="required span12">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="da-form-inline">
                        <legend data-icon="icon-user">Member</legend>
                        <div class="da-form-row">
                            <label class="da-form-label">Fullname <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="wizard[fullname]" class="required span12">
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Address <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <textarea name="wizard[address]" class="required span12"></textarea>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Gender <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                    <li><input type="radio" name="wizard[gender]" class="required"> <label>Male</label></li>
                                    <li><input type="radio" name="wizard[gender]"> <label>Female</label></li>
                                </ul>
                                <label for="wizard[gender]" class="error" generated="true" style="display:none"></label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="da-form-inline">
                        <legend data-icon="icon-asterisk">Membership</legend>
                        <div class="da-form-row">
                            <label class="da-form-label">Membership Period <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <select name="wizard[period]" class="required span12">
                                    <option>1 Month</option>
                                    <option>3 Months</option>
                                    <option>6 Months</option>
                                    <option>1 Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Package <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                    <li><input type="radio" name="wizard[package]" class="required"> <label>Basic</label></li>
                                    <li><input type="radio" name="wizard[package]"> <label>Full</label></li>
                                    <li><input type="radio" name="wizard[package]"> <label>Premium</label></li>
                                </ul>
                                <label for="wizard[package]" class="error" generated="true" style="display:none"></label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="da-form-inline">
                        <legend data-icon="icon-ok">Confirmation</legend>
                        <div class="da-form-row">
                            <label class="da-form-label">Payment Method <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <select name="wizard[payment]" class="required span12">
                                    <option>PayPal</option>
                                    <option>Visa</option>
                                    <option>Mastercard</option>
                                    <option>Wire Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <div class="da-form-item large">
                                <ul class="da-form-list inline">
                                    <li>
                                        <input type="checkbox" name="wizard[tos]" class="required"> 
                                        <label>I agree to the terms of service <span class="required">*</span></label>
                                    </li>
                                </ul>
                                <label for="wizard[tos]" class="error" generated="true" style="display:none"></label>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icon-calendar"></i>
                    Holiday Calendar
                </span>

            </div>
            <div class="da-panel-content with-padding">
                <div id="da-ex-calendar-gcal"></div>
            </div>
        </div>
    </div>
</div>