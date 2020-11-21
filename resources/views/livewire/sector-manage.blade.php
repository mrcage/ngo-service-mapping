<div>
    <h2>Manage Sectors</h2>
    <form wire:submit.prevent="submit">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="fit"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        $isEditor = optional($selectedItem)->id === $item->id;
                    @endphp
                    <tr>
                        <td class="p-1 align-middle">
                            @if($isEditor)
                                <input
                                    type="text"
                                    id="name"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    placeholder="Name"
                                    wire:model.defer="selectedItem.name"
                                    class="form-control form-control-sm @error("selectedItem.name") is-invalid @enderror"
                                >
                                @error("selectedItem.name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @else
                                {{ $item->name }}
                            @endif
                        </td>
                        <td class="p-1 fit">
                            @if($isEditor)
                                <button
                                    type="submit"
                                    class="btn btn-success btn-sm"
                                    aria-label="Save"
                                >
                                    <span
                                        wire:loading
                                        wire:target="submit"
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"></span>
                                    <span
                                        wire:loading.remove
                                        wire:target="submit"><x-bi-check-circle/></span>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary btn-sm"
                                    wire:click="cancelEdit"
                                    aria-label="Cancel"
                                >
                                    <x-bi-x-circle/>
                                </button>
                            @else
                                @can('update', $item)
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm"
                                        wire:click="editItem('{{ $item->getRouteKey() }}')"
                                        aria-label="Edit"
                                    >
                                        <x-bi-pencil-fill/>
                                    </button>
                                @endcan
                                @can('delete', $item)
                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm"
                                        wire:click="deleteItem('{{ $item->getRouteKey() }}')"
                                        aria-label="Delete"
                                    >
                                        <x-bi-trash/>
                                    </button>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
                @can('create', App\Model\Sector::class)
                    @php
                        $isEditor = $selectedItem !== null && $selectedItem->id === null;
                    @endphp
                    <tr>
                        <td class="p-1 align-middle">
                            @if($isEditor)
                                <input
                                    type="text"
                                    id="name"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    placeholder="Name"
                                    wire:model.defer="selectedItem.name"
                                    class="form-control form-control-sm @error("selectedItem.name") is-invalid @enderror"
                                >
                                @error("selectedItem.name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @endif
                        </td>
                        <td class="p-1 fit">
                            @if($isEditor)
                                <button
                                    type="submit"
                                    class="btn btn-success btn-sm"
                                    aria-label="Save"
                                >
                                    <span
                                        wire:loading
                                        wire:target="submit"
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"></span>
                                    <span
                                        wire:loading.remove
                                        wire:target="submit"><x-bi-check-circle/></span>
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary btn-sm"
                                    wire:click="cancelEdit"
                                    aria-label="Cancel"
                                >
                                    <x-bi-x-circle/>
                                </button>
                            @else
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm"
                                    wire:click="newItem"
                                    aria-label="Create"
                                >
                                    <x-bi-plus-circle/>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endcan
            </tbody>
        </table>
    </form>
    <p>
        <a href="{{ route('sectors.index') }}">Return to list of sectors</a>
    </p>
</div>
