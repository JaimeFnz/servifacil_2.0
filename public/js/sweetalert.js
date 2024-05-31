function confirmDelete(id) {
    console.log('confirmDelete - Started');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result) {
            console.log('confirmDelete - Result confirmed ');
            document.getElementById('deleteForm' + id).submit();
        }
    console.log('confirmDelete - Canceled');
});
}

// <form id="deleteForm{{ $row['id'] }}"
// action="{{ route('co.delete', $row['id']) }}" method="POST" class="mx-1">
// @csrf
// @method('DELETE')
// <button type="button" class="btn btn-xs btn-danger mx-1" title="Eliminar"
//     onclick="confirmDelete('{{ $row['id'] }}')">
//     <i class="fa fa-trash"></i>
// </button>
// </form>