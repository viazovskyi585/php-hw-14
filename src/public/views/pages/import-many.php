<button id="btn" onclick="importUsers()" type="button" class="d-block mt-4 mx-auto btn btn-primary">Import many users</button>

<script>
	let loadingImport = false;

	function getRandomInt(min, max) {
		min = Math.ceil(min);
		max = Math.floor(max);
		return Math.floor(Math.random() * (max - min)) + min;
	}

	async function importUsers() {
		if (loadingImport) {
			return;
		}
		loadingImport = true;
		const limit = 2;
		const skip = getRandomInt(0, 100);
		const response = await fetch('https://dummyjson.com/users?limit=' + limit + '&skip=' + skip)
		const data = await response.json()
		const users = data.users;

		const usersToImport = users.map(user => {
			return {
				name: user.firstName + ' ' + user.lastName,
				age: user.age,
				email: user.email
			}
		})

		const responseImport = await fetch('/create-many', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({
				users: usersToImport
			})
		})

		window.btn.remove()
		document.body.innerHTML += '<h1 class="text-center">Success</h1><br><a href="/users">Back to users</a>'
	}
</script>
