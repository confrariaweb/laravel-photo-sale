<x-template-layout>
    <div class="row">
        <div class="col-4">
            <h4>{{ $user->name }}</h4>
        </div>
        <div class="col-8 text-right">
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <div class="btn-group" role="group" aria-label="">
                    <a href="#" class="btn btn-secondary">Voltar</a>
                    <a href="#" class="btn btn-success">Salvar</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="user-row">
        <div class="col-12">
            <form class="needs-validation" novalidate="">
                <div class="row">
                    <h4 class="col-12">Informações gerais</h4>
                    <div class="col-6">
                        <label for="firstName">Nome</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Seu nome" value=""
                               required="">
                    </div>
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Seu e-mail">
                    </div>

                    <div class="col-6">
                        <label for="password">Email</label>
                        <input type="password" class="form-control" id="password" placeholder="Seu e-mail">
                    </div>
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Seu e-mail">
                    </div>

                </div>
                <hr>
                <div class="row">
                    <h4 class="col-12">Endereço</h4>
                    <div class="col-4">
                        <label for="zip">CEP</label>
                        <input type="text" class="form-control" id="cep" placeholder="" required="">
                    </div>
                    <div class="col-4">
                        <label for="country">País</label>
                        <input type="text" class="form-control" id="country" placeholder="Seu País">
                    </div>
                    <div class="col-4">
                        <label for="state">Estado</label>
                        <input type="text" class="form-control" id="state" placeholder="Seu Estado">
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="address">Bairro</label>
                        <input type="text" class="form-control" id="district" placeholder="Seu bairro"
                               required="">
                    </div>
                    <div class="col-5">
                        <label for="address">Rua</label>
                        <input type="text" class="form-control" id="address" placeholder="Sua rua" required="">
                    </div>
                    <div class="col-4">
                        <label for="address2">Complemento <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="complement" placeholder="Complemento">
                    </div>
                </div>
                <hr/>
            </form>
        </div>
    </div>

</x-template-layout>


