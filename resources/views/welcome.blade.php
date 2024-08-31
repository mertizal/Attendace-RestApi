<x-layout> 
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Table</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-slate-700 p-6">
  <div class="container mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center" style ="color:#f28208">Geni User Table</h1>
    <div class="overflow-x-auto">
  <table class="min-w-full bg-gray-900 text-white rounded-lg shadow-md">
    <thead class="bg-gray-700 text-gray-400 uppercase text-sm leading-normal">
      <tr>
        <th class="py-3 px-6 text-left">Name</th>
        <th class="py-3 px-6 text-left">Attendance</th>
        <th class="py-3 px-6 text-left">Attendance Date</th>
      </tr>
    </thead>
    <tbody class="text-gray-300 text-sm">
      @foreach($data as $item)
      <tr class="border-b border-gray-700 hover:bg-gray-600">
        <td class="py-3 px-6 text-left">{{$item['user_name']}}</td>
        <td class="py-3 px-6 text-left">{{$item['status']}}</td>
        <td class="py-3 px-6 text-left">{{$item['date']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="mt-4">
        {{ $data->links() }} 
  </div>
</div>

  </div>
</body>
</html>
</x-layout>
