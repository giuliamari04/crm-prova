<section>
    <button class="btn bottone-indietro"><a href="{{route('admin.home')}}"><i class="fa-solid fa-circle-chevron-left fs-1 "></i></a></button>
    <div>
        <form wire:submit.prevent="save">
            @csrf
            <div class="container px-5">
                {{-- prima riga --}}
                <div class="row py-2">
                    <div class="mx-3 col">
                        <label for="name">Nome</label><br>
                        <input type="text" id="name" class=" form-control " placeholder="Inserisci nome" wire:model="firstName"
                            value="name">
                    </div>
                    <div class="mx-3 col col">
                        <label for="surname">Cognome</label><br>
                        <input type="text" id="surname" class=" form-control " placeholder="Inserisci cognome" wire:model="lastName"
                            value="surname">
                    </div>
                    <div class="mx-3 col">
                        <label for="email">Email</label><br>
                        <input type="text" id="email" class=" form-control " placeholder="Inserisci email" wire:model="email"
                            value="email">
                    </div>
                    <div class="mx-3 col">
                        <label for="phone">Numero di telefono</label><br>
                        <input type="text" id="phone" class=" form-control "
                            placeholder="Inserisci numero di telefono" wire:model="phone" value="phone">
                    </div>
                </div>
                {{-- seconda riga --}}
                <div class="row py-2">
                    <div class="mx-3 col">
                        <label for="cf">Codice Fiscale</label><br>
                        <input type="text" id="cf" class=" form-control "
                            placeholder="Inserisci codice fiscale" wire:model="cf" value="cf">
                    </div>
                    <div class="mx-3 col">
                        <label for="industry">Settore:</label> <br>
                        <input type="text" id="industry" class=" form-control "  placeholder="settore" wire:model="industry" value="industry">
                    </div>

                    <div class="mx-3 col">
                        <label for="status">Status:</label> <br>
                        <select id="status" class=" form-control " wire:model="status">
                            <option value="">Scegli opzione</option>
                            <option value="potenziale" >Potenziale</option>
                            <option value="attivo" >Attivo</option>
                            <option value="ex" >Ex</option>
                        </select>
                    </div>
                    <div class="mx-3 col">
                        <label for="companyName">Azienda:</label> <br>
                        <select id="company_id" class="form-control" wire:model="company_id">
                            <option value="">Seleziona un'azienda</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row py-2 mx-2">
                    <div class="col-3">
                         <label for="pIva">Vuoi aggiungere una partita iva?</label>
                    <input type="text" class="form-control" wire:model="pIva" id="pIva" value="pIva">
                    </div>


                    <div class="col-3 ">
                         <label for="start">Vuoi aggiungere una data di inizio contratto?</label>
                    <input type="date" class="form-control" wire:model="start" id="start" value="start">
                    </div>



                  <div class="col-3 ">
                       <label for="end">Vuoi aggiungere una data di fine contratto?</label>
                  <input type="date" class="form-control" wire:model="end" id="end" value="end">
                  </div>

                </div>
            <button type="submit" class="btn btn-primary m-3  ">Conferma</button>
            </div>

        </form>
    </div>
    @if (@session('success'))
        <span class=" bg-success btn btn-success ">{{session('success')}}</span>
    @endif
    @error('firstName')
    <span class="text-red-500">{{ $message }}</span>
@enderror

</section>
