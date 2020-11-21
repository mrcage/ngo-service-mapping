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
                @foreach ($sectors as $index => $sector)
                    @php
                        $markedForDeletion = in_array($index, $deletedIndexes);
                    @endphp
                    <tr>
                        <td class="p-1">
                            <input
                                type="text"
                                id="name"
                                required
                                autocomplete="off"
                                placeholder="Name"
                                wire:model.defer="sectors.{{ $index }}.name"
                                class="form-control form-control-sm @error("sectors.$index.name") is-invalid @enderror"
                                @if($markedForDeletion) disabled @endif
                            >
                            @error("sectors.$index.name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </td>
                        <td class="p-1 fit">
                            <button
                                type="button"
                                class="btn @if($markedForDeletion) btn-danger @else btn-warning @endif btn-sm"
                                wire:click="deleteItem('{{ $index }}')"
                                {{-- @cannot('delete', $sector) disabled title="Can only delete sector if no organizations are assigned" @endcannot --}}
                            >
                                @if($markedForDeletion)
                                    <x-bi-x-circle/>
                                @else
                                    <x-bi-trash/>
                                @endif
                            </button>
                        </td>
                    </tr>
                @endforeach
                @foreach ($newSectors as $index => $sector)
                    {{-- @php
                        $markedForDeletion = in_array($index, $deletedIndexes);
                    @endphp --}}
                    <tr>
                        <td class="p-1">
                            <input
                                type="text"
                                id="name"
                                required
                                autocomplete="off"
                                placeholder="Name"
                                {{-- wire:model.defer="sectors.{{ $index }}.name" --}}
                                {{-- class="form-control form-control-sm @error("sectors.$index.name") is-invalid @enderror" --}}
                                {{-- @if($markedForDeletion) disabled @endif --}}
                            >
                            {{-- @error("sectors.$index.name") <div class="invalid-feedback">{{ $message }}</div> @enderror --}}
                        </td>
                        <td class="p-1 fit">
                            <button
                                type="button"
                                class="btn @if($markedForDeletion) btn-danger @else btn-warning @endif btn-sm"
                                {{-- wire:click="deleteItem('{{ $index }}')" --}}
                                {{-- @cannot('delete', $sector) disabled title="Can only delete sector if no organizations are assigned" @endcannot --}}
                            >
                                @if($markedForDeletion)
                                    <x-bi-x-circle/>
                                @else
                                    <x-bi-trash/>
                                @endif
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="p-1">
                        <input
                            type="text"
                            id="name"
                            autocomplete="off"
                            placeholder="Name"
                            wire:model.defer="newItem.name"
                            class="form-control form-control-sm @error("name") is-invalid @enderror">
                        @error("name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </td>
                    <td class="p-1 fit">
                        <button
                            type="button"
                            class="btn btn-success btn-sm"
                            wire:click="addItem"
                        >
                            <x-bi-plus-circle/>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">
                <span wire:loading wire:target="submit">Saving...</span>
                <span wire:loading.remove wire:target="submit">Save changes</span>
            </button>
            <a href="{{ route('sectors.index') }}">Cancel</a>
        </p>
    </form>
</div>
