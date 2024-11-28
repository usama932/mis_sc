@if ($role == 'f_p')
    <a class="btn-icon mx-1" href="{{ route('project.detail', $project->id) }}" title="Edit Project">
        <i class="fas fa-pencil-alt text-warning"></i>
    </a>
@endif

@if (auth()->user()->user_type == 'admin')
    <a class="btn-icon mx-1" href="{{ route('project.detail', $project->id) }}" title="Edit Project">
        <i class="fas fa-pencil-alt text-warning"></i>
    </a>
    <a class="btn-icon mx-1" onclick="event.preventDefault(); del({{ $project->id }});" title="Delete Project" href="#">
        <i class="fas fa-trash-alt text-danger"></i>
    </a>
@endif

<a class="btn-icon mx-1" href="{{ route('projects.show', $project->id) }}" target="_blank" title="Show Project">
    <i class="far fa-eye text-success"></i>
</a>