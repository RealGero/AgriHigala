<template>
    <ul>
        <li>halo</li>
        <!-- <li v-if="notifications.length != 0">
            <a class="dropdown-item" href="#" v-on:click="MarkAllAsRead()">
                <small class="font-weight-bold"> <u>Mark all as read</u></small>
            </a>
        </li> -->
        <li v-for="notification in notifications" v-bind:key="notification">
            <a class="dropdown-item" href="\#" v-on:click="MarkAsRead(notification)">
                someone
                <small>{{ JSON.parse(notification.data).announcement.message }}</small>
            </a>
        </li>
        <!-- <li v-if="notifications.length == 0">
            <a class="dropdown-item" href="#">
                <small class="text-secondary font-italic">No new notification</small>
            </a>
        </li> -->
    </ul>
</template>

<script>
    export default {
        props: ['notifications']
    }
</script>
