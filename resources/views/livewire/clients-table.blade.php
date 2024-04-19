<!-- resources/views/livewire/table.blade.php -->

<div>
    <form wire:submit.prevent="refreshClients" class="d-flex flex-wrap">
        <div class="mx-3">
        <label for="name">Nome</label><br>
        <input type="text" id="name" placeholder="Inserisci nome" wire:model.lazy="nameFilter">
        </div>
        <div class="mx-3">
        <label for="surname">Cognome</label><br>
        <input type="text" id="surname" placeholder="Inserisci cognome" wire:model.lazy="surnameFilter">
        </div>
        <div class="mx-3">
            <label for="email">Email</label><br>
            <input type="text" id="email" placeholder="Inserisci email" wire:model.lazy="emailFilter">
        </div>
        <div class="mx-3">
            <label for="phone">Numero di telefono</label><br>
            <input type="text" id="phone" placeholder="Inserisci numero di telefono" wire:model.lazy="phoneFilter">
        </div>
        <div class="mx-3">
            <label for="cf">Codice Fiscale</label><br>
            <input type="text" id="cf" placeholder="Inserisci codice fiscale" wire:model.lazy="cfFilter">
        </div>

        <div class="mx-3">
            <label for="industryFilter">Settore:</label> <br>
            <select wire:model="industryFilter" id="industryFilter" wire:change="refreshClients">
                <option value="">Tutti</option>
                @if($industries->isNotEmpty())
                    @foreach ($industries as $industry)
                        <option value="{{ $industry }}">{{ $industry }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mx-3">
            <label for="statusFilter">Status:</label> <br>
        <select wire:model="statusFilter" id="statusFilter" wire:change="refreshClients">
            <option value="">Tutti</option>
            <option value="potenziale">Potenziale</option>
            <option value="attivo">Attivo</option>
            <option value="ex">Ex</option>
        </select>
        </div>
        <div class="mx-3">
            <label for="companyFilter">Azienda:</label> <br>
        <select wire:model="companyFilter" id="companyFilter" wire:change="refreshClients">
            <option value="">Tutti</option>
            @if($companies->isNotEmpty())
            @foreach ($companies as $company)
                <option value="{{ $company->client_id }}">{{ $company->name }}</option>
            @endforeach
        @endif
        </select>
        </div>

    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Stato</th>
                <th>Azienda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)

            <tr>
                <td>{{ $client->first_name }}</td>
                <td>{{ $client->last_name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->status }}</td>
                @foreach($companies as $company)
                @if ($client->id === $company->client_id)
                    <td>{{ $company->name ?? 'N/A' }}</td>
                @endif
                @endforeach

            </tr>

            @endforeach
        </tbody>
    </table>
</div>
