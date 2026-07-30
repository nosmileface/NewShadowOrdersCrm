<div class="modal fade" id="editModal{{ $clientStatusCategory->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('client-categories.status-categories.update', [$clientCategory->id, $clientStatusCategory->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="_client_status_category_id" value="{{ $clientStatusCategory->id }}">

                <div class="modal-header">
                    <h5 class="modal-title">Редактировать категорию статуса</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Название</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $clientStatusCategory->name) }}" placeholder="Введите название" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Тип</label>
                            <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $clientStatusCategory->type) }}" placeholder="Введите тип" required>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

@if ($errors->any() && old('_client_status_category_id') == $clientStatusCategory->id)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal{{ $clientStatusCategory->id }} = new bootstrap.Modal(document.getElementById('editModal{{ $clientStatusCategory->id }}'));
            editModal{{ $clientStatusCategory->id }}.show();
        });
    </script>
@endif
