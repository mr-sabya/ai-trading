<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Notifications</h5>
            <div>
                <button wire:click="markAllAsRead" class="btn btn-sm btn-success">
                    <i class="fa fa-check"></i> Mark All as Read
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input wire:model.debounce.300ms="search" type="text" class="form-control"
                        placeholder="Search notifications...">
                </div>
                <div class="col-md-3">
                    <select wire:model="filter" class="form-select">
                        <option value="all">All</option>
                        <option value="unread">Unread</option>
                        <option value="read">Read</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model="perPage" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Message</th>
                            <th>Package</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $index => $notification)
                        @php
                        $data = $notification->data;
                        $isUnread = is_null($notification->read_at);
                        @endphp
                        <tr class="{{ $isUnread ? 'table-warning' : '' }}">
                            <td>{{ $notifications->firstItem() + $index }}</td>
                            <td>{{ $data['message'] ?? 'Notification' }}</td>
                            <td>{{ $data['package'] ?? '-' }}</td>
                            <td>{{ $data['price'] ?? '-' }}</td>
                            <td>
                                @if($isUnread)
                                <span class="badge bg-warning text-dark">Unread</span>
                                @else
                                <span class="badge bg-success">Read</span>
                                @endif
                            </td>
                            <td>{{ $notification->created_at->format('d M Y h:i A') }}</td>
                            <td>
                                @if($isUnread)
                                <button wire:click="markAsRead('{{ $notification->id }}')" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Read
                                </button>
                                @else
                                <button wire:click="markAsUnread('{{ $notification->id }}')" class="btn btn-sm btn-warning">
                                    <i class="fa fa-undo"></i> Unread
                                </button>
                                @endif

                                @if(!empty($data['purchase_id']))
                                <a href="{{ route('admin.purchase.show', $data['purchase_id']) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No notifications found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>