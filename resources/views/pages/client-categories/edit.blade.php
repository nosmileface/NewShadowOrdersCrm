<div class="modal fade" id="editModal{{ $clientCategory->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('client-categories.update', $clientCategory->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Редактировать категорию</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Название</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $clientCategory->name) }}" placeholder="Введите название" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label">Тип</label>
                            <input type="text" name="type" class="form-control" value="{{ old('type', $clientCategory->type) }}" placeholder="Введите тип" required>
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
