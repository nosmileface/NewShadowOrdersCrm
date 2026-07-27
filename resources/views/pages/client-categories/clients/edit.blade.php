<div class="modal fade" id="editModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('client-categories.clients.update', [$clientCategory->id, $client->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="_client_id" value="{{ $client->id }}">

                <div class="modal-header">
                    <h5 class="modal-title">Редактировать клиента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Название</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $client->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Код</label>
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $client->code) }}">
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Адрес</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $client->address) }}">
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Телефон</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $client->phone) }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Юридическое лицо</label>
                            <input type="text" name="legal_entity" class="form-control @error('legal_entity') is-invalid @enderror" value="{{ old('legal_entity', $client->legal_entity) }}">
                            @error('legal_entity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label class="form-label">ИНН</label>
                            <input type="text" name="inn" class="form-control @error('inn') is-invalid @enderror" value="{{ old('inn', $client->inn) }}">
                            @error('inn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">ОГРН</label>
                            <input type="text" name="ogrn" class="form-control @error('ogrn') is-invalid @enderror" value="{{ old('ogrn', $client->ogrn) }}">
                            @error('ogrn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col mb-0">
                            <label class="form-label">КПП</label>
                            <input type="text" name="kpp" class="form-control @error('kpp') is-invalid @enderror" value="{{ old('kpp', $client->kpp) }}">
                            @error('kpp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any() && old('_client_id') == $client->id)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal{{ $client->id }} = new bootstrap.Modal(document.getElementById('editModal{{ $client->id }}'));
            editModal{{ $client->id }}.show();
        });
    </script>
@endif
