<section>
    <button class="btn bottone-indietro"><a href="{{route('admin.company.home')}}"><i class="fa-solid fa-circle-chevron-left fs-1 "></i></a></button>
    <div>
        <form wire:submit.prevent="save">
            @csrf
            <div class="container px-5">
                {{-- prima riga --}}
                <div class="row py-2">
                    <div class="mx-3 col">
                        <label for="name">Nome</label><br>
                        <input type="text" id="name" class=" form-control " placeholder="Inserisci nome" wire:model="name"
                            value="name">
                    </div>
                    <div class="mx-3 col">
                        <label for="email">Email</label><br>
                        <input type="email" id="email" class=" form-control " placeholder="Inserisci email" wire:model="email"
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
                        <label for="address">Indirizzo</label><br>
                        <input type="text" id="address" class=" form-control "
                            placeholder="Inserisci Indirizzo" wire:model="address" value="address">
                    </div>
                    <div class="mx-3 col">
                        <label for="city">citta</label><br>
                        <input type="text" id="city" class=" form-control "
                            placeholder="Inserisci Indirizzo" wire:model="city" value="city">
                    </div>
                    <div class="mx-3 col">
                        <label for="postal_code">CAP</label><br>
                        <input type="text" id="postal_code" class=" form-control "
                            placeholder="Inserisci Indirizzo" wire:model="postal_code" value="postal_code">
                    </div>
                    <div class="mx-3 col">
                        <label for="province">Provincia</label><br>
                        <input type="text" id="province" class=" form-control "
                            placeholder="Inserisci Indirizzo" wire:model="province" value="province">
                    </div>
                    <div class="mx-3 col">
                        <label for="country">Paese</label><br>
                        <input type="text" id="country" class=" form-control "
                            placeholder="Inserisci Indirizzo" wire:model="country" value="country">
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

                </div>
                <div class="row py-2 mx-2">
                    <div class="col-3">
                         <label for="website">Vuoi aggiungere una sito web?</label>
                    <input type="text" class="form-control" wire:model="website" id="website" value="website">
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
