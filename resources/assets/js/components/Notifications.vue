<template>
	<div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<span>Notifications</span>
			</div>

			<div class="panel-body">
				<p style="margin-bottom: 0;" v-if="notifications.length === 0">
					You do not have any notifications.
				</p>

				<table class="table table-borderless" style="margin-bottom: 0;" v-if="notifications.length > 0">
					<thead>
						<tr>
							<th>Icon</th>
							<th>Package</th>
							<th>Title</th>
							<th>Text</th>
							<th>Sub Text</th>
							<th>Group</th>
						</tr>
					</thead>

					<tbody>
						<tr v-for="notification in notifications">
							<!-- Icon -->
							<td style="vertical-align: middle;">
								<img src="data:image/png;base64,{{ notification.iconBase64 }}"/>
							</td>

							<!-- Package Name -->
							<td style="vertical-align: middle;">
								{{ notification.packageName }}
							</td>

							<!-- Title -->
							<td style="vertical-align: middle;">
								{{ notification.title }}
							</td>

							<!-- Text -->
							<td style="vertical-align: middle;">
								{{ notification.text }}
							</td>

							<!-- Sub Text -->
							<td style="vertical-align: middle;">
								{{ notification.subText }}
							</td>

							<!-- Group -->
							<td style="vertical-align: middle;">
								{{ notification.group }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				notifications: []
			}
		},

		mounted() {
			this.prepareComponent();
		},

		methods() {
			prepareComponent() {
				this.getNotifications();
			},

			getNotifications() {
				this.$http.get('/api/notifications')
					.then(response => {
						this.notifications = response.data;
					});
			}
		}
	}
</script>