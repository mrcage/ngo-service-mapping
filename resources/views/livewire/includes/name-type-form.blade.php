<form wire:submit.prevent="submit">
    <table class="table table-striped table-condensed">
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
                    $isDelete = optional($deletionItem)->id === $item->id;
                @endphp
                <tr class="@if($isDelete) table-danger @endif">
                    <td class="p-1 align-middle">
                        @if($isEditor)
                            <input
                                type="text"
                                id="name"
                                required
                                autocomplete="off"
                                placeholder="Name"
                                class="form-control form-control-sm @error("selectedItem.name") is-invalid @enderror"
                                wire:model.defer="selectedItem.name"
                            >
                            @error("selectedItem.name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @elseif($isDelete)
                            <del>{{ $item->name }}</del>
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
                                wire:key="submit_{{ $loop->index }}"
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
                                wire:key="cancelEdit_{{ $loop->index }}"
                            >
                                <x-bi-x-circle/>
                            </button>
                        @elseif($isDelete)
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                aria-label="Delete"
                                wire:click="deleteItem"
                                wire:key="deleteItem{{ $loop->index }}"
                            >
                                <span
                                    wire:loading
                                    wire:target="deleteItem"
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"></span>
                                <span
                                    wire:loading.remove
                                    wire:target="deleteItem"><x-bi-trash/></span>
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary btn-sm"
                                aria-label="Cancel"
                                wire:click="cancelDelete"
                                wire:key="cancelDelete_{{ $loop->index }}"
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
                                    wire:key="editItem_{{ $loop->index }}"
                                >
                                    <x-bi-pencil-fill/>
                                </button>
                            @endcan
                            @can('delete', $item)
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm"
                                    wire:click="confirmDeleteItem('{{ $item->getRouteKey() }}')"
                                    aria-label="Delete"
                                    wire:key="confirmDeleteItem_{{ $loop->index }}"
                                >
                                    <x-bi-trash/>
                                </button>
                            @endcan
                        @endif
                    </td>
                </tr>
            @endforeach
            @if($this->allowCreate)
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
                                autocomplete="off"
                                placeholder="Name"
                                class="form-control form-control-sm @error("selectedItem.name") is-invalid @enderror"
                                wire:model.defer="selectedItem.name"
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
                                wire:key="submit_0"
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
                                wire:key="cancelEdit_0"
                            >
                                <x-bi-x-circle/>
                            </button>
                        @else
                            <button
                                type="button"
                                class="btn btn-primary btn-sm"
                                wire:click="newItem"
                                aria-label="Create"
                                wire:key="newItem_0"
                            >
                                <x-bi-plus-circle/>
                            </button>
                        @endif
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <p><small>There are {{ $items->count() }} items in total.</small></p>
</form>

@push('scripts')
<script>
    window.addEventListener('livewire:load', () => {
        @this.on('editorReady', () => {
            document.querySelector('input#name').focus()
        })
    })
</script>
@endpush
