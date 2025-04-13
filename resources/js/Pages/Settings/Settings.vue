<script setup>
import Layout from "../Shared/Layout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    store_id: "",
    store_password: "",
    currency: "",
    success_url: "",
    fail_url: "",
    cancel_url: "",
    ipn_url: "",
    init_url: "",
});
</script>

<template>
    <Layout>
        <!-- Main Content -->
        <main class="ml-64 p-8">
            <h2 class="text-2xl font-bold mb-6">Settings</h2>
            <form class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">
                    SSLCommerz Payment Gateway Configuration
                </h3>
                <div class="mb-4">
                    <label
                        for="store-id"
                        class="block text-gray-700 font-bold mb-2"
                        >Store ID</label
                    >
                    <input
                        type="text"
                        id="store-id"
                        class="w-full p-2 border rounded-md"
                        placeholder="Enter Store ID"
                        required v-model="form.store_id"
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="store-password"
                        class="block text-gray-700 font-bold mb-2"
                        >Store Password</label
                    >
                    <input
                        type="text"
                        id="store-password"
                        class="w-full p-2 border rounded-md"
                        placeholder="Enter Store Password"
                        required v-model="form.store_password"
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="success-url"
                        class="block text-gray-700 font-bold mb-2"
                        >Success URL</label
                    >
                    <input
                        type="text"
                        id="success-url"
                        class="w-full p-2 border rounded-md"
                        placeholder="Enter Success URL (e.g., /payment/success)"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="fail-url"
                        class="block text-gray-700 font-bold mb-2"
                        >Fail URL</label
                    >
                    <input
                        type="text"
                        id="fail-url"
                        class="w-full p-2 border rounded-md"
                        placeholder="Enter Fail URL (e.g., /payment/fail)"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="cancel-url"
                        class="block text-gray-700 font-bold mb-2"
                        >Cancel URL</label
                    >
                    <input
                        type="text"
                        id="cancel-url"
                        class="w-full p-2 border rounded-md"
                        placeholder="Enter Cancel URL (e.g., /payment/cancel)"
                        required
                    />
                </div>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md"
                >
                    Save Settings
                </button>
            </form>
        </main>
    </Layout>
</template>

<style></style>
