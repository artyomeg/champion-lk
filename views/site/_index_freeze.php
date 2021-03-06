<!-- Modal -->
<div id="_freeze" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!-- Form itself -->
                <form name="sentMessage" class="form form-register1 form_ajax" id="contactForm" method="post">

                    <div class="control-group">
                        <h4>Оставить заявку на заморозку абонемента:</h4>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input 
                                type="text"
                                class="form-control" 
                                onblur='if (this.value == "") this.placeholder = "Телефон"'
                                onfocus='if (this.value == "Телефон") this.value = ""' 
                                placeholder="Телефон" 
                                id="phone"
                                required
                                data-validation-required-message="Пожалуйста, укажите номер телефона"
                                name="phone"
                                />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <textarea
                                class="form-control"
                                placeholder="Укажите желаемое время и опишите причину заморозки"
                                rows="3"
                                name="why"
                                required
                                ></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>  

                    <div class="status-text"></div> <!-- For success/fail messages -->
                    
                    <div class="control-group">
                        <input type="hidden" name="want" value="freeze"/>
                        <button type="submit" class="btn pull-right btn-primary">Отправить</button><br />      
                    </div>  

                    <div class="clearfix"> </div>

                </form>

            </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
    </div><!-- End of Modal dialog -->
</div><!-- End of Modal -->