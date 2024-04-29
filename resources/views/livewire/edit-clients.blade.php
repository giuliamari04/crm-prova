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
                            value="{{ old('name', $client->first_name) }}">
                            @error('firstName')
                            <div class="my-3 d-flex justify-content-center ">
                                <span class="alert alert-danger ">{{ $message }}</span>
                            </div>
                            @enderror
                    </div>
                    <div class="mx-3 col col">
                        <label for="surname">Cognome</label><br>
                        <input type="text" id="surname" class=" form-control " placeholder="Inserisci cognome" wire:model="lastName"
                            value="{{ old('surname', $client->last_name) }}">
                            @error('lastName')
                            <div class="my-3 d-flex justify-content-center ">
                                <span class="alert alert-danger ">{{ $message }}</span>
                            </div>
                            @enderror
                    </div>
                    <div class="mx-3 col">
                        <label for="email">Email</label><br>
                        <input type="email" id="email" class=" form-control " placeholder="Inserisci email" wire:model="email"
                            value="{{ old('email', $client->email) }}">
                            @error('email')
                            <div class="my-3 d-flex justify-content-center ">
                                <span class="alert alert-danger ">{{ $message }}</span>
                            </div>
                            @enderror
                    </div>
                    <div class="mx-3 col">
                        <label for="phone">Numero di telefono</label><br>
                        <input type="text" id="phone" class=" form-control "
                            placeholder="Inserisci numero di telefono" wire:model="phone" value="{{ old('phone', $client->phone) }}">
                            @error('phone')
                            <div class="my-3 d-flex justify-content-center ">
                                <span class="alert alert-danger ">{{ $message }}</span>
                            </div>
                            @enderror
                    </div>
                </div>
                {{-- seconda riga --}}
                <div class="row py-2">
                    <div class="mx-3 col">
                        <label for="cf">Codice Fiscale</label><br>
                        <input type="text" id="cf" class=" form-control "
                            placeholder="Inserisci codice fiscale" wire:model="cf" value="{{ old('cf', $client->codice_fiscale) }}">
                            @error('cf')
                            <div class="my-3 d-flex justify-content-center ">
                                <span class="alert alert-danger ">{{ $message }}</span>
                            </div>
                            @enderror
                    </div>
                    <div class="mx-3 col">
                        <label for="industryFilter">Settore:</label> <br>
                        <select id="industryFilter" class=" form-control " wire:model="industry"
                            value="{{ old('industry', $client->industry) }}">
                            @if ($industries->isNotEmpty())
                                @foreach ($industries as $industry)
                                    <option value="{{ $industry }}"
                                        {{ $client->industry == $industry ? 'selected' : '' }}>{{ $industry }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('industry')
                        <div class="my-3 d-flex justify-content-center ">
                            <span class="alert alert-danger ">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="mx-3 col">
                        <label for="statusFilter">Status:</label> <br>
                        <select id="statusFilter" class=" form-control " wire:model="status">
                            <option value="potenziale" {{ $client->status == 'potenziale' ? 'selected' : '' }}>Potenziale
                            </option>
                            <option value="attivo" {{ $client->status == 'attivo' ? 'selected' : '' }}>Attivo</option>
                            <option value="ex" {{ $client->status == 'ex' ? 'selected' : '' }}>Ex</option>
                        </select>
                        @error('status')
                        <div class="my-3 d-flex justify-content-center ">
                            <span class="alert alert-danger ">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="mx-3 col">
                        <label for="companyName">Azienda:</label> <br>
                        <select id="company_id" class="form-control" wire:model="company_id">
                            <option value="">Seleziona un'azienda</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ $client->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('companyName')
                        <div class="my-3 d-flex justify-content-center ">
                            <span class="alert alert-danger ">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row py-2 mx-2">
                    @if ($client->p_iva !== null)
                      <div class="col-3">
                        <label for="pIva">Partita IVA</label>
                        <input type="text" class="form-control mt-4" wire:model="pIva" id="pIva" value="{{ old('pIva', $client->p_iva) }}">
                        @error('pIva')
                        <div class="my-3 d-flex justify-content-center ">
                            <span class="alert alert-danger ">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @else
                    <div class="col-3">
                         <label for="pIva">Vuoi aggiungere una partita iva?</label>
                    <input type="text" class="form-control" wire:model="pIva" id="pIva">
                    @error('pIva')
                    <div class="my-3 d-flex justify-content-center ">
                        <span class="alert alert-danger ">{{ $message }}</span>
                    </div>
                    @enderror
                    </div>
                    @endif

                    @if ($client->contract_start_date !== null)
                      <div class="col-3 ">
                        <label for="start">Inizio Contratto</label>
                        <input type="date" class="form-control mt-4" wire:model="start" id="start" value="{{ old('start', $client->contract_start_date) }}">
                    </div>
                    @else
                    <div class="col-3 ">
                         <label for="start">Vuoi aggiungere una data di inizio contratto?</label>
                    <input type="date" class="form-control" wire:model="start" id="start">
                    </div>
                    @endif

                    @if ($client->contract_end_date !== null)
                    <div class="col-3 ">
                      <label for="end">Fine Contratto</label>
                      <input type="date" class="form-control mt-4" wire:model="end" id="end" value="{{ old('end', $client->contract_end_date) }}">
                  </div>
                  @else
                  <div class="col-3 ">
                       <label for="end">Vuoi aggiungere una data di fine contratto?</label>
                  <input type="date" class="form-control" wire:model="end" id="end">
                  </div>
                  @endif
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
