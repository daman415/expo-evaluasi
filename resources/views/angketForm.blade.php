<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Angket</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
        integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'>
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100"
    style="background-image: url('{{ asset('assets/img/bgwp.svg') }}'); background-size: cover; background-position: center;"
    class="bg-gray-100">


    <nav class="border-gray-200 bg-green-700 mb-10">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">EXPO2024</span>
            </a>
            <button data-collapse-toggle="navbar-solid-bg" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-solid-bg" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                <ul
                    class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                    <li>
                        <a href="{{ route('indexLp') }}"
                            class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto">
        <div class="max-w-xs mx-auto bg-white rounded-md p-6 shadow-md lg:max-w-2xl mt-5">

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Terimakasih ayang @Vestia Zeta",
                        text: "Karena Success nanti dicium Zetas"
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oppss, Ayo benerin",
                        text: "kalau bener nanti dipeluk zeta"
                    });
                </script>
            @endif

            <form id="myForm" action="{{ route('angket.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 class="text-2xl font-semibold mb-4">Data Diri:</h2>
                <input type="hidden" name="acaraId" value="{{ $acara->id }}">
                <div class="mb-5">
                    <label for="nama"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="vestia Zeta" required>
                </div>

                <!-- Input for Email -->
                <div class="mb-5">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="zeta@gmail.com" required>
                </div>
                <div class="mb-5">
                    <label for="instansi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Angket
                        Untuk</label>
                    <select name="instansi" id="instansi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                        <option value="" readonly='true'>--Select Angket--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->role }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="max-w-xs mx-auto bg-white rounded-md p-6 shadow-md lg:max-w-2xl mt-5">
                    <h2 class="text-2xl font-semibold mb-4 p-5">Soal Angket {{ $acara->nama_acara }}</h2>
                    <div id="questions-container" class="mb-4 p-10">
                        <div id="questions" class="space-y-4">
                            <!-- Questions will be inserted here -->

                        </div>
                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4 float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
    integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'>
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('#instansi').change(function() {
        var selected_option = $(this).val();
        $.ajax({
            url: 'http://localhost:8000/api/pertanyaan-role/' + selected_option,
            type: 'get',
            cache: false,
            success: function(data) {
                var questionsDiv = document.getElementById('questions');
                questionsDiv.innerHTML = '';
                console.log(data.data);
                data.data.forEach(function(question, index) {
                    var questionDiv = document.createElement('div');
                    console.log(question.id, question.pertanyaan);
                    questionDiv.innerHTML = `
                        <p class="text-lg font-medium">${index + 1}: ${question.pertanyaan}</p>
                    <div class="ml-5">
                    <label class="block">
                        <input type="radio" name="jawaban[${question.id}]" value="4" required class="mt-2">
                        <span class="ml-2">Sangat Baik</span>
                    </label>
                    <label class="block">
                        <input type="radio" name="jawaban[${question.id}]" value="3" required class="mt-2">
                        <span class="ml-2">Baik</span>
                    </label>
                    <label class="block">
                        <input type="radio" name="jawaban[${question.id}]" value="2" required class="mt-2">
                        <span class="ml-2">Kurang baik</span>
                    </label>
                    <label class="block">
                        <input type="radio" name="jawaban[${question.id}]" value="1" required class="mt-2">
                        <span class="ml-2">Sangat kurang baik</span>
                    </label>
                    <input type="hidden" name="question_ids[]" value="${question.id}">
                    </div>
                    `;

                    questionsDiv.append(questionDiv);
                });
            }
        });
    });
</script>

</html>
