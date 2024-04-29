<style>
    #resultsTable {
        width: 100%;
        border-collapse: collapse;
    }

    #resultsTable th {
        white-space: nowrap;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
    }

    #resultsTable th, #resultsTable td {
        border: 1px solid #ddd;
    }

    #resultsTable tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #resultsTable tr:hover {
        background-color: #ddd;
    }
</style>

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
                    <form id="searchForm" class="my-4">
                        <input type="text" name="name" placeholder="漢字氏名" oninput="fetchData()" class="mr-2">
                        <input type="text" name="last_name_kana" placeholder="カナ（姓）" oninput="fetchData()" class="mr-2">
                        <input type="text" name="first_name_kana" placeholder="カナ（名）" oninput="fetchData()" class="mr-2">
                        <input type="text" name="email" placeholder="メールアドレス" oninput="fetchData()" class="mr-2">
                        <input type="text" name="insurance_card_number" placeholder="保険証番号" oninput="fetchData()" class="mr-2">
                        <input type="text" name="insurance_card_symbol" placeholder="保険証記号" oninput="fetchData()" class="mr-2">
                    </form>
                    <div style="overflow-x: auto;">
                        <table id="resultsTable" class="w-full">
                            <thead>
                                <tr>
                                    <th>漢字氏名</th>
                                    <th>カナ（姓）</th>
                                    <th>カナ（名）</th>
                                    <th>メールアドレス</th>
                                    <th>保険証番号</th>
                                    <th>保険証記号</th>
                                    <th>委託元保険者</th>
                                    <th>所属保険者</th>
                                    <th>保険者番号</th>
                                    <th>支援レベル</th>
                                    <th>性別</th>
                                    <th>生年月日</th>
                                    <th>年齢</th>
                                    <th>健診日</th>
                                    <th>身長</th>
                                    <th>健診時体重</th>
                                    <th>BMI</th>
                                    <th>健診時腹囲</th>
                                    <th>収縮期1</th>
                                    <th>収縮期2</th>
                                    <th>収縮期その他</th>
                                    <th>拡張期1</th>
                                    <th>拡張期2</th>
                                    <th>拡張期その他</th>
                                    <th>中性脂肪</th>
                                    <th>空腹時中性脂肪</th>
                                    <th>随時中性脂肪</th>
                                    <th>HDL</th>
                                    <th>LDL</th>
                                    <th>GOT</th>
                                    <th>GPT</th>
                                    <th>γ-GT</th>
                                    <th>空腹時血糖</th>
                                    <th>随時血糖</th>
                                    <th>HBA1C</th>
                                    <th>服薬1</th>
                                    <th>服薬2</th>
                                    <th>服薬3</th>
                                    <th>喫煙</th>
                                    <th>初回面談日</th>
                                    <th>初回面談時間</th>
                                    <th>対象者の特徴</th>
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
                                        <td>{{ $insured->principal_insurer }}</td>
                                        <td>{{ $insured->affiliated_insurer }}</td>
                                        <td>{{ $insured->insurer_number }}</td>
                                        <td>{{ $insured->support_level }}</td>
                                        <td>{{ $insured->gender }}</td>
                                        <td>{{ $insured->birth_date }}</td>
                                        <td>{{ $insured->age }}</td>
                                        <td>{{ $insured->checkup_date }}</td>
                                        <td>{{ $insured->height }}</td>
                                        <td>{{ $insured->weight }}</td>
                                        <td>{{ $insured->bmi }}</td>
                                        <td>{{ $insured->waist }}</td>
                                        <td>{{ $insured->systolic1 }}</td>
                                        <td>{{ $insured->systolic2 }}</td>
                                        <td>{{ $insured->systolic_other }}</td>
                                        <td>{{ $insured->diastolic1 }}</td>
                                        <td>{{ $insured->diastolic2 }}</td>
                                        <td>{{ $insured->diastolic_other }}</td>
                                        <td>{{ $insured->triglycerides }}</td>
                                        <td>{{ $insured->fasting_triglycerides }}</td>
                                        <td>{{ $insured->casual_triglycerides }}</td>
                                        <td>{{ $insured->hdl_cholesterol }}</td>
                                        <td>{{ $insured->ldl_cholesterol }}</td>
                                        <td>{{ $insured->got }}</td>
                                        <td>{{ $insured->gpt }}</td>
                                        <td>{{ $insured->gamma_gt }}</td>
                                        <td>{{ $insured->fasting_glucose }}</td>
                                        <td>{{ $insured->casual_glucose }}</td>
                                        <td>{{ $insured->hba1c }}</td>
                                        <td>{{ $insured->medication1 }}</td>
                                        <td>{{ $insured->medication2 }}</td>
                                        <td>{{ $insured->medication3 }}</td>
                                        <td>{{ $insured->smoking }}</td>
                                        <td>{{ $insured->initial_interview_date }}</td>
                                        <td>{{ $insured->initial_interview_time }}</td>
                                        <td>{{ $insured->characteristics }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                                        <td>${item.principal_insurer}</td>
                                        <td>${item.affiliated_insurer}</td>
                                        <td>${item.insurer_number}</td>
                                        <td>${item.support_level}</td>
                                        <td>${item.gender}</td>
                                        <td>${item.birth_date}</td>
                                        <td>${item.age}</td>
                                        <td>${item.checkup_date}</td>
                                        <td>${item.height}</td>
                                        <td>${item.weight}</td>
                                        <td>${item.bmi}</td>
                                        <td>${item.waist}</td>
                                        <td>${item.systolic1}</td>
                                        <td>${item.systolic2}</td>
                                        <td>${item.systolic_other}</td>
                                        <td>${item.diastolic1}</td>
                                        <td>${item.diastolic2}</td>
                                        <td>${item.diastolic_other}</td>
                                        <td>${item.triglycerides}</td>
                                        <td>${item.fasting_triglycerides}</td>
                                        <td>${item.casual_triglycerides}</td>
                                        <td>${item.hdl_cholesterol}</td>
                                        <td>${item.ldl_cholesterol}</td>
                                        <td>${item.got}</td>
                                        <td>${item.gpt}</td>
                                        <td>${item.gamma_gt}</td>
                                        <td>${item.fasting_glucose}</td>
                                        <td>${item.casual_glucose}</td>
                                        <td>${item.hba1c}</td>
                                        <td>${item.medication1}</td>
                                        <td>${item.medication2}</td>
                                        <td>${item.medication3}</td>
                                        <td>${item.smoking}</td>
                                        <td>${item.initial_interview_date}</td>
                                        <td>${item.initial_interview_time}</td>
                                        <td>${item.characteristics}</td>
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
