<form id="estimate-shipping-cost" class="box-form-request-quote-2 repeater" action="api/estimate-shipping-cost"
    method="post">
    <div class="box-form-contact-leading">

        <p class="font-md color-grey-700 mb-25 wow animate__animated animate__fadeIn">Please Fill All
            Inquiry To Get Your Total Price.</p>
        <div class="row align-items-center wow animate__animated animate__fadeIn">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Pickup Pincode *</span>
                    <input name="pickup_pincode" pattern="[0-9]{6}" class="form-control" type="text"
                        placeholder="Pickup Pincode" required="required">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">Delivery Pincode *</span>
                    <input name="delivery_pincode" pattern="[0-9]{6}" class="form-control" type="text"
                        placeholder="Delivery Pincode" required="required">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">Total Weight (Kg) *</span>
                    <input name="weight" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" type="number"
                        placeholder="Total Weight" required="required">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">Invoice Value *</span>
                    <input name="invoice_value" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control"
                        type="number" placeholder="Invoice Value *" required="required">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">Mode of Transport</span>
                    <select class="form-control" name="mode_of_transport">
                        <option value="Service 4">Road Transport</option>
                        <option value="Service 3">Rail Transport</option>
                        <option value="Service 1">Air Freight</option>
                        <option value="Service 2">Ocean Freght</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon">Unit of Measurement</span>
                    <select id="dimension_unit" class="form-control" name="dimension_unit">
                        <option value="Feet">Feet</option>
                        <option value="Inch">Inch</option>
                    </select>
                </div>
            </div>


            <div data-repeater-list="shipment_boxes">
                <div data-repeater-item>
                    <div class="row-">
                        <div class="col-lg-11">

                            <div class="row">
                                <div class="col-lg-3">

                                    <div class="input-group">
                                        <span class="input-group-addon"># of Box</span>
                                        <input name="no_of_box" class="form-control" type="number"
                                            placeholder="No# of Boxes *" value="1" required="required">

                                    </div>
                                </div>
                                <div class="col-lg-3  pl-0">
                                    <div class="input-group">
                                        <span class="input-group-addon">Lt</span>
                                        <input name="length" class="form-control" pattern="[0-9]+([\.,][0-9]+)?"
                                            step="0.01" type="number" placeholder="Length" required="required">
                                        <span class="input-group-addon mx-unit">Ft</span>
                                    </div>
                                </div>
                                <div class="col-lg-3  pl-0">
                                    <div class="input-group">
                                        <span class="input-group-addon">Wd</span>
                                        <input name="width" class="form-control" pattern="[0-9]+([\.,][0-9]+)?"
                                            step="0.01" type="number" placeholder="Width" required="required">
                                        <span class="input-group-addon mx-unit">Ft</span>

                                    </div>
                                </div>
                                <div class="col-lg-3 pl-0  ">

                                    <div class="input-group">
                                        <span class="input-group-addon">Ht</span>
                                        <input name="height" class="form-control" pattern="[0-9]+([\.,][0-9]+)?"
                                            step="0.01" type="number" placeholder="Height" required="required">
                                        <span class="input-group-addon mx-unit">Ft</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <a data-repeater-delete class="repeater-delete pull-right">
                                <span>x</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <button type="button" data-repeater-create class="btn btn-primary pull-left">
                    Add More Boxes
                </button>
                <button type="submit" class="btn  btn-primary  pull-right">
                    Estimate Shipping Cost
                </button>
            </div>
        </div>
    </div>
</form>

<?php include "modal-popup.php" ?>