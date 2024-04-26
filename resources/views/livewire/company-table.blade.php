<!-- resources/views/livewire/table.blade.php -->

<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-between py-3">
        <h1>Lista companyi</h1>
        <button class="btn btn-success" wire:click="redirectToCratePage()">Crea nuova azienda</button>
    </div>

    <section class="accordion mb-4 bordo-tabella" id="accordionPanelsStayOpenExample">
        <div class="accordion-item border-0 ">
            <h2 class="accordion-header border-0 ">
                <button class="accordion-button bg-transparent border-0  " type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                    Pannello per filtrare dati
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <form wire:submit.prevent="refreshCompanies" class="d-flex flex-wrap accordion-body ">
                    <div class="container">
                        {{-- prima riga --}}
                        <div class="row py-2">
                            <div class="mx-3 col">
                                <label for="name">Nome</label><br>
                                <input type="text" id="name" class=" form-control " placeholder="Inserisci nome"
                                    wire:model.lazy="nameFilter">
                            </div>

                            <div class="mx-3 col">
                                <label for="email">Email</label><br>
                                <input type="text" id="email" class=" form-control "
                                    placeholder="Inserisci email" wire:model.lazy="emailFilter">
                            </div>
                            <div class="mx-3 col">
                                <label for="phone">Numero di telefono</label><br>
                                <input type="text" id="phone" class=" form-control "
                                    placeholder="Inserisci numero di telefono" wire:model.lazy="phoneFilter">
                            </div>

                            <div class="mx-3 col">
                                <label for="cf">Indirizzo</label><br>
                                <input type="text" id="addressFilter" class=" form-control "
                                    placeholder="Inserisci indirizzo" wire:model.lazy="addressFilter">
                            </div>


                        </div>
                        {{-- seconda riga --}}
                        <div class="row py-2">


                            <div class="mx-3 col">
                                <label for="cf">CAP</label><br>
                                <input type="text" id="postal_code" class=" form-control "
                                    placeholder="Inserisci CAP" wire:model.lazy="postal_codeFilter">
                            </div>

                            <div class="mx-3 col">
                                <label for="cf">Città</label><br>
                                <input type="text" id="cityFilter" class=" form-control "
                                    placeholder="Inserisci città" wire:model.lazy="cityFilter">
                            </div>
                            <div class="mx-3 col">
                                <label for="cf">Provincia</label><br>
                                <input type="text" id="provinceFilter" class=" form-control "
                                    placeholder="Inserisci provincia" wire:model.lazy="provinceFilter">
                            </div>

                            <div class="mx-3 col">
                                <label for="cf">Paese</label><br>
                                <input type="text" id="countryFilter" class=" form-control "
                                    placeholder="Inserisci paese" wire:model.lazy="countryFilter">
                            </div>



                        </div>
                        <div class="row py-2 w-50">
                            <div class="mx-3 col">
                                <label for="industryFilter">Settore:</label> <br>
                                <select wire:model="industryFilter" id="industryFilter" class=" form-control "
                                    wire:change="refreshCompanies">
                                    <option value="">Tutti</option>
                                    @if ($industries->isNotEmpty())
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry }}">{{ $industry }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mx-3 col">
                                <label for="statusFilter">Status:</label> <br>
                                <select wire:model="statusFilter" id="statusFilter" class=" form-control "
                                    wire:change="refreshCompanies">
                                    <option value="">Tutti</option>
                                    <option value="potenziale">Potenziale</option>
                                    <option value="attivo">Attivo</option>
                                    <option value="ex">Ex</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end mx-4 pt-2 w-100">
                        <button type="reset" class="btn btn-danger" wire:click="resetForm">Svuota campi</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
    <section class="bordo-tabella">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Città</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @if ($companies->isEmpty())
                    <tr>
                        <td colspan="7">
                            <span class="d-flex justify-content-center">Nessun dato presente con queste
                                caratteristiche</span>
                        </td>
                    </tr>
                @else
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{$company->id}}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->phone_number }}</td>
                            <td>{{$company->city}}</td>
                            <td>{{ $company->status }}</td>




                            <td class="d-flex">

                                <button class="btn btn-primary mx-1 "
                                    wire:click="redirectToDetailPage({{ $company->id }})"><i
                                        class="fa-solid fa-circle-info"></i></button>
                                <button class="btn btn-warning mx-1 "
                                    wire:click="redirectToEditPage({{ $company->id }})"><i
                                        class="fa-solid fa-user-pen"></i></button>


                                <button class="btn btn-danger mx-1"
                                    wire:click="deletecompany({{ $company->id }})"
                                    wire:confirm="Conferma Eliminazione Azienda \n \n Sei sicuro che vuoi cancellare l'azienda {{$company->name}} dalla lista? \n \n Se sei sicuro clicca su ---> ok \n Oppure per tornare alla lista companyi clicca su ---> Annulla"
                                    >
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div>
            {{ $companies->links() }}
        </div>




    </section>
    <div>
