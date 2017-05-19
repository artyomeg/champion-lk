<!-- Modal -->
<div id="_sendletter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!-- Form itself -->
                <form name="sentMessage" class="form form-register1" id="contactForm"  novalidate>

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
                                ></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>


                    <div id="success"></div> <!-- For success/fail messages -->
                    
                    <div class="control-group">
                        <button type="submit" class="btn pull-right">Отправить</button><br />      
                    </div>  

                    <div class="clearfix"> </div>

                </form>

            </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
    </div><!-- End of Modal dialog -->
</div><!-- End of Modal -->