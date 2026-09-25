@extends('layouts.app')

@section('content')
    <script>
        let allAuthors = []; // Store full dataset locally to filter fast without extra API calls

        const deleteAuthor = async function (id) {
            await fetch('/api/authors/' + id, {
                method: 'DELETE',
            });
        };

        const renderTable = function(authors) {
            const tableBody = document.getElementById('table-body');
            tableBody.innerHTML = "";

            if (authors.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="6" class="py-4 text-center text-gray-500">No matching authors found</td></tr>`;
                return;
            }

            authors.forEach(function(author) {
                const row = 
                `
                    <tr class="odd:bg-white even:bg-slate-50">
                        <td class="py-2 px-1 font-mono">${author.id} </td>
                        <td>${author.name} </td>
                        <td class="font-mono text-gray-500">${author.birth_date ?? ''} </td>
                        <td class="font-mono text-gray-500">${author.created_at ?? ''} </td>
                        <td class="font-mono text-gray-500">${author.updated_at ?? ''} </td>
                        <td class="flex gap-1"> 
                            <a class="text-sm min-w-10 text-center font-sm p-1 rounded-sm bg-blue-500 hover:bg-blue-800 text-white font-semibold hover:cursor-pointer" href="authors/${author.id}"> View </a> 
                            <a class="text-sm min-w-10 text-center font-sm p-1 rounded-sm bg-blue-500 hover:bg-blue-800 text-white font-semibold hover:cursor-pointer" href="api/authors/${author.id}/edit"> Edit </a>
                            <button class="delete-btn text-sm min-w-10 text-center p-1 rounded-sm bg-red-700 hover:bg-red-800 text-white font-semibold hover:cursor-pointer" data-id="${author.id}"> Delete </button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        };

        const loadAuthors = async function() {
            const response = await fetch("/api/authors");
            allAuthors = await response.json();
            filterAndRender();
        };

        const filterAndRender = function() {
            const searchTerm = $('#search-input').val().toLowerCase().trim();
            
            const filteredAuthors = allAuthors.filter(author => {
                const name = (author.name || '').toLowerCase();
                return name.includes(searchTerm);
            });

            renderTable(filteredAuthors);
        };

        $(document).ready(function() {
            loadAuthors();

            // Real-time search filter on input
            $('#search-input').on('keyup input', function() {
                filterAndRender();
            });

            $('table').on('click', '.delete-btn', async function() {
                let authorId = $(this).data('id');
                console.log("Deleting record ID:", authorId);
                await deleteAuthor(authorId);
                await loadAuthors();
            });
        });
    </script>

    <div class="mb-4 flex justify-between items-center min-w-5xl">
        <input 
            type="text" 
            id="search-input" 
            placeholder="Search by ID, name, or birth date..." 
            class="px-3 py-2 border border-gray-300 rounded-md text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <a class="p-2 rounded-sm bg-green-600 hover:bg-green-700 text-white text-sm font-semibold" href="/authors/create">Add author</a>
    </div>

    <table class="table-fixed min-w-5xl text-sm">
        <thead class="text-sm font-medium text-left">
            <tr>
                <th> id </th>
                <th> name </th>
                <th> birth_date </th>
                <th> created_at </th>
                <th> updated_at </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody id="table-body">
        </tbody>
    </table>
@endsection