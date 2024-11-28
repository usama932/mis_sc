@can('read dip')

    @if(auth()->user()->user_type != 'admin')
        @php
            $notifications = \App\Models\Notification::where('notifiable_id', auth()->user()->id)->latest()->get();
        @endphp
    @else
        @php
            $notifications = \App\Models\Notification::latest()->get();
        @endphp
    @endif
    <div class="card menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
        
        <h4 class="card-header mt-4">Notifications:</h4>
        <div class="tab-content">
            <div class="scroll-y my-5 px-8" style="max-height: 400px; overflow-y: auto;">
                @foreach ($notifications as $notification)
                    @php
                        $data = json_decode($notification->data, true);
                        $created_at = \Carbon\Carbon::parse($notification->created_at);
                        $dateDiff = \Carbon\Carbon::now()->diffInDays($created_at);
                        $activity = \App\Models\DipActivity::find($data['activity_id']);
            
                        if ($created_at->isToday()) {
                            $timeAgo = $created_at->diffForHumans();
                        } elseif ($created_at->isYesterday()) {
                            $timeAgo = 'Yesterday';
                        } else {
                            $timeAgo = $created_at->format('d M Y');
                        }
                    @endphp
                    <div class="d-flex flex-stack py-4">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-35px me-4">
                                @if(auth()->user()->id != $notification->read_by)
                                    <span class="symbol-label bg-light-primary"><i class="fa-solid fa-message"></i></span>
                                @else
                                    <span class="symbol-label bg-light-primary"><i class="fa-regular fa-message"></i></span>
                                @endif
                            </div>
                            <div class="mb-0 ">
                                <a href="{{ route('activity_dips.show', $data['activity_id']) }}" class="fs-9 text-gray-800 text-hover-primary fw-bold">{{ $data['message'] }}</a>
                               {{-- // <div class="text-gray-400 fs-9">{{ $data['message'] }}</div> --}}
                            </div>
                        </div>
                        <span class="badge badge-light fs-8">{{ $timeAgo }}</span>
                    </div>
                @endforeach
            </div>
            
            
        </div>
    </div>
@endcan