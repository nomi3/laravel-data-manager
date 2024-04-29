<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            保険証データ管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>登録されている保険証の情報を閲覧できます。</p>
                    <a href="{{ route('insureds.create') }}">新規登録</a>

                    <form id="searchForm" class="my-4">
                        <input type="text" name="name" placeholder="漢字氏名" oninput="fetchData()" class="mr-2">
                        <input type="text" name="last_name_kana" placeholder="カナ（姓）" oninput="fetchData()" class="mr-2">
                        <input type="text" name="first_name_kana" placeholder="カナ（名）" oninput="fetchData()" class="mr-2">
                        <input type="text" name="email" placeholder="メールアドレス" oninput="fetchData()" class="mr-2">
                        <input type="text" name="insurance_card_number" placeholder="保険証番号" oninput="fetchData()" class="mr-2">
                        <input type="text" name="insurance_card_symbol" placeholder="保険証記号" oninput="fetchData()" class="mr-2">
                    </form>

                    <table id="resultsTable" class="w-full">
                        <thead>
                            <tr>
                                <th>漢字氏名</th>
                                <th>カナ（姓）</th>
                                <th>カナ（名）</th>
                                <th>メールアドレス</th>
                                <th>保険証番号</th>
                                <th>保険証記号</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insureds as $insured)
                                <tr>
                                    <td>{{ $insured->name }}</td>
                                    <td>{{ $insured->last_name_kana }}</td>
                                    <td>{{ $insured->first_name_kana }}</td>
                                    <td>{{ $insured->email }}</td>
                                    <td>{{ $insured->insurance_card_number }}</td>
                                    <td>{{ $insured->insurance_card_symbol }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        function fetchData() {
                            const form = document.getElementById('searchForm');
                            const formData = new FormData(form);
                            const searchParams = new URLSearchParams(formData).toString();

                            fetch(`/insureds/search?${searchParams}`)
                            .then(response => response.json())
                            .then(data => {
                                const tableBody = document.getElementById('resultsTable').getElementsByTagName('tbody')[0];
                                tableBody.innerHTML = '';
                                data.forEach(item => {
                                    const row = `<tr>
                                        <td>${item.name}</td>
                                        <td>${item.last_name_kana}</td>
                                        <td>${item.first_name_kana}</td>
                                        <td>${item.email}</td>
                                        <td>${item.insurance_card_number}</td>
                                        <td>${item.insurance_card_symbol}</td>
                                    </tr>`;
                                    tableBody.innerHTML += row;
                                });
                            })
                            .catch(error => console.error('Error:', error));
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
