
<div class="widget-content widget-content-area">

    <input type="hidden" class="form-control" id="invoice_id" name="invoice_id" value="">

        <div class="form-group mb-4">
            <label for="exampleFormControlInput2">To</label>
            <input type="email" class="form-control" id="to_email" name="to_email" placeholder="name@example.com">
        </div>

        <div class="form-group mb-4">
            <label for="exampleFormControlInput2">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Email subject">
        </div>

        <div class="form-group mb-4">
            <label for="exampleFormControlTextarea1">Body</label>
            <textarea class="form-control editor" id="mail_content" rows="10" name="mail_content">
                <br>Dear {CLIENT_NAME},<br><br>Please check our quotation offer on {QUOTE_LINK}<br><br>Hope to hear back soon from you.<br><br>Best Regards,<br>Three Media<br>
            </textarea>
        </div>
</div>
