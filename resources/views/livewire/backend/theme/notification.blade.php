<li class="nav-item topbar-icon dropdown hidden-caret">
    <a
        class="nav-link dropdown-toggle"
        href="#"
        id="notifDropdown"
        role="button"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        <i class="fa fa-bell"></i>
        @if($unreadCount > 0)
        <span class="notification">{{ $unreadCount }}</span>
        @endif
    </a>

    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
        <li>
            <div class="dropdown-title">
                You have {{ $unreadCount }} new notification{{ $unreadCount > 1 ? 's' : '' }}
            </div>
        </li>

        <li>
            <div class="notif-scroll scrollbar-outer">
                <div class="notif-center">
                    @forelse($notifications as $notification)
                    @php
                    $data = $notification->data;
                    $isUnread = is_null($notification->read_at);
                    @endphp
                    <a href="{{ route('admin.purchase.show', $data['purchase_id']) }}" wire:navigate wire:click="markAsRead('{{ $notification->id }}')">
                        <div class="notif-icon {{ $isUnread ? 'notif-primary' : 'notif-success' }}">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="notif-content">
                            <span class="block">
                                {{ $data['message'] ?? 'New notification' }}
                            </span>
                            <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    <div class="text-center p-3 text-muted">No notifications</div>
                    @endforelse
                </div>
            </div>
        </li>

        <li>
            <a class="see-all" href="javascript:void(0);" wire:click="markAllAsRead">
                Mark all as read <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</li>