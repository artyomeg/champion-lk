<!-- Modal -->
<div id="_sendletter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!-- Form itself -->
                <form name="sentMessage" class="form form-register1 form_ajax" id="contactForm" method="post"  novalidate>

                    <div class="control-group">
                        <h4>Написать письмо руководству клуба:</h4>
                    </div>
<!--                    <div class="control-group">
                        <div class="controls">
                            <input 
                                type="text"
                                class="form-control" 
                                placeholder="E-mail" 
                                id="phone"
                                value="<?= Yii::$app->user->identity->email ?>"
                                required
                                />
                        </div>
                    </div>-->
                    <div class="control-group">
                        <div class="controls">
                            <textarea
                                class="form-control"
                                placeholder="Текст сообщения"
                                rows="4"
                                name="letter_text"
                                ></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <div class="status-text"></div> <!-- For success/fail messages -->
                    
                    <div class="control-group">
                        <input type="hidden" name="want" value="sendletter"/>
                        <button type="submit" class="btn pull-right btn-primary">Отправить</button><br />      
                    </div>  

                    <div class="clearfix"> </div>

                </form>

            </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
    </div><!-- End of Modal dialog -->
</div><!-- End of Modal -->