<script context="module">
	import Layout from './Layout.svelte'
	export const layout = Layout
</script>

<script>
export let user
</script>

<h1>Welcome</h1>
<p>Hello {user.name}, welcome to your first Inertia app!</p>