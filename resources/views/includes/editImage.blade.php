@if (Auth::user() && Auth::user()->id == $image->user_id)
                            <div class="actions">
                                <a href="{{route('Image.edit',['id'=>$image->id])}}" class="btn btn-primary btn-sm">Editar</a>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ConfirmarDelete">
                                    Borrar
                                </button>
                                
                                <!-- The Modal -->
                                <div class="modal" id="ConfirmarDelete">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Confirmar</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            Estas seguro que quieres borrar esta imagen <strong>PARA SIEMPRE</strong>?
                                        </div>
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                            <a href="{{route('Image.delete',['id'=>$image->id])}}" class="btn btn-danger">Borrar definitivamente</a>
                                        </div>
                                
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif