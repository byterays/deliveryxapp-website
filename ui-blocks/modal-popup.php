<div class="modal fade " id="opt-callback" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">


        <form id="query-contact-detail" class="" action="api/update-query-contact" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-11">
                            <h3 class="modal-title fs-5" id="staticBackdropLabel">Enter your Contact Details</h3>
                        </div>
                        <div class="col-lg-1"><button type="button" class="btn-close btn-sm btn-danger"
                                data-bs-dismiss="modal" aria-label="Close">X</button></div>
                    </div>


                </div>
                <div class="modal-body">


                    <div class="input-group">
                        <span class="input-group-addon">Name</span>
                        <input name="contact_name" class="form-control" type="text" placeholder="Enter Your Name*"
                            required="required">

                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Phone</span>
                        <input name="contact_number" pattern="[0-9]{10}" class="form-control" type="number"
                            placeholder="Enter Your Number*" required="required">


                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">Email (Optional)</span>
                        <input name="contact_email" class="form-control" type="email" placeholder="Enter Your Email">


                    </div>

                    <div class="consent-note">
                        <div class="alert alert-primary " role="alert">
                            By clicking the "Continue" button, you agree to be contacted by TNT or its
                            agents
                            regarding your query for shipment cost estimation.
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Leave</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </div>
        </form>


    </div>
</div>


<div class="modal fade " id="estimate-result" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-lg-11">
                        <h3 class="modal-title fs-5" id="staticBackdropLabel">Estimated Approx. Cost</h3>
                    </div>
                    <div class="col-lg-1"><button type="button" class="btn-close btn-sm btn-danger"
                            data-bs-dismiss="modal" aria-label="Close">X</button></div>
                </div>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr class="table-warning">
                        <th>Pickup Location</th>
                        <td><span id="pickup-location"></span></td>
                    </tr>
                    <tr class="table-info">
                        <th>Delivery Location</th>
                        <td><span id="delivery-location"></span></td>
                    </tr>
                    <tr class="table-secondary">
                        <th>No# of Boxes</th>
                        <td><span id="num-box"></span></td>
                    </tr>
                    <tr class="table-primary">
                        <th>Total Weight</th>
                        <td><span id="total-weight"></span> Kg</td>
                    </tr>

                    <tr class="table-success">
                        <th>Estimated Cost</th>
                        <td>
                            <h5 id="estimated-cost"></h5>
                        </td>
                    </tr>
                </table>

                <div class="consent-note">
                    <div class="alert alert-primary " role="alert">
                        The estimated cost is approxmiated based on provided data. The actual cost may vary on actual
                        transaction.
                        The estimated cost includes 18% GST.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="request-call-back" class="btn btn-success cta-contact">Request Call
                    Back</button>
                <button type="button" id="request-quote" class="btn btn-primary cta-contact">Request a Quote</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade " id="cta-request-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">

                <div class="row">
                    <div class="col-lg-11">
                        <h3 class="modal-title fs-5" id="staticBackdropLabel">Request Confirmation</h3>
                    </div>
                    
                </div>
            </div>
            <div class="modal-body">


                <div class="consent-note">
                    <div class="alert alert-success " role="alert">
                        Thank you for your interest. Your request has been submitted successfully. Our representative
                        will be in touch with you soon.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>