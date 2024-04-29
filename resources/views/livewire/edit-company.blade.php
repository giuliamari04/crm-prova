<section>
    <button class="btn bottone-indietro"><a href="{{route('admin.company')}}"><i class="fa-solid fa-circle-chevron-left fs-1 "></i></a></button>
    <div>
        <form wire:submit.prevent="save">
            @csrf
            <div class="container px-5">
                {{-- prima riga --}}
                <div class="row py-2">
                    <div class="mx-3 col">
                        <label for="name">Nome</label><br>
                        <input type="text" id="name" class=" form-control " placeholder="Inserisci nome" wire:model="name"
                            value="{{ old('name', $company->name) }}">
                    </div>
                    <div class="mx-3 col">
                        <label for="email">Email</label><br>
                        <input type="email" id="email" class=" form-control " placeholder="Inserisci email" wire:model="email"
                            value="{{ old('email', $company->email) }}">
                    </div>
                    <div class="mx-3 col">
                        <label for="phone">Numero di telefono</label><br>
                        <input type="text" id="phone" class=" form-control "
                            placeholder="Inserisci numero di telefono" wire:model="phone" value="{{ old('phone', $company->phone_number) }}">
                    </div>
                </div>
                {{-- seconda riga --}}
                <div class="row py-2">


                    <div class="mx-3 col">
                        <label for="address">Indirizzo</label><br>
                        <input type="text" id="address" class=" form-control "
                            placeholder="Inserisci indirizzo azienda" wire:model="address" value="{{ old('address', $company->address) }}">
                    </div>
                    <div class="mx-3 col">
                        <label for="city">città</label><br>
                        <input type="text" id="city" class=" form-control "
                            placeholder="Inserisci indirizzo azienda" wire:model="city" value="{{ old('city', $company->city) }}">
                    </div>
                    <div class="mx-3 col">
                        <label for="postal_code">CAP</label><br>
                        <input type="text" id="postal_code" class=" form-control "
                            placeholder="Inserisci indirizzo azienda" wire:model="postal_code" value="{{ old('postal_code', $company->postal_code) }}">
                    </div>
                    <div class="mx-3 col">
                        <label for="province">Provincia</label><br>
                        <input type="text" id="province" class=" form-control "
                            placeholder="Inserisci indirizzo azienda" wire:model="province" value="{{ old('province', $company->province) }}">
                    </div>
                    <div class="mx-3 col">
                        <label for="country">Paese</label><br>
                        <input type="text" id="country" class=" form-control "
                            placeholder="Inserisci indirizzo azienda" wire:model="country" value="{{ old('country', $company->country) }}">
                    </div>


                </div>
                <div class="row py-2">
                    <div class="mx-3 col">
                        <label for="statusFilter">Status:</label> <br>
                        <select id="statusFilter" class=" form-control " wire:model="status">
                            <option value="potenziale" {{ $company->status == 'potenziale' ? 'selected' : '' }}>Potenziale
                            </option>
                            <option value="attivo" {{ $company->status == 'attivo' ? 'selected' : '' }}>Attivo</option>
                            <option value="ex" {{ $company->status == 'ex' ? 'selected' : '' }}>Ex</option>
                        </select>
                    </div>
                    <div class="mx-3 col">
                        <label for="industryFilter">Settore:</label> <br>
                        <select id="industryFilter" class=" form-control " wire:model="industry"
                            value="{{ old('industry', $company->industry) }}">
                            @if ($industries->isNotEmpty())
                                @foreach ($industries as $industry)
                                    <option value="{{ $industry }}"
                                        {{ $company->industry == $industry ? 'selected' : '' }}>{{ $industry }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @if ($company->website !== null)
                      <div class="col-3">
                        <label for="website">Sito web</label>
                        <input type="text" class="form-control" wire:model="website" id="website" value="{{ old('website', $company->website) }}">
                    </div>
                    @else
                    <div class="col-3">
                         <label for="website">Vuoi aggiungere una sito web dell'adienda?</label>
                    <input type="text" class="form-control" wire:model="website" id="website">
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
