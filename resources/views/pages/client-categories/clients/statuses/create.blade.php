<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('client-categories.clients.client-statuses.store', [$clientCategory->id, $client->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Добавить статус клиента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Название</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Введите название" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Тип</label>
                            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" placeholder="Введите тип" required>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">CRM</label>
                            <select name="crm_id" class="form-select @error('crm_id') is-invalid @enderror" required>
                                <option value="">Выберите CRM</option>
                                @foreach($crms as $crm)
                                    <option value="{{ $crm->id }}" @selected(old('crm_id') == $crm->id)>{{ $crm->name }}</option>
                                @endforeach
                            </select>
                            @error('crm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

@if ($errors->any() && !old('_client_status_id'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var createModal = new bootstrap.Modal(document.getElementById('createModal'));
            createModal.show();
        });
    </script>
@endif
