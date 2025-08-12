# TASK.md

## Purpose
- Primary tracking document for all project work
- Maintains real-time visibility of progress
- Serves as single source of truth for task status

## Structure
### Active Work (Prioritized)
- [ ] Create Main Pokémon List Page (Laravel Blade & Controller)
- [ ] Create Pokémon Detail Page (Laravel Blade & Controller)
- [ ] Implement Previous/Next Navigation (Laravel)

### Backlog
- [ ] Implement search functionality
- [ ] Add filtering by Pokémon type
- [ ] Create user authentication system

### Discoveries
❗ Important findings during implementation:
- API calls should be handled by a dedicated service class.

### Completed (Auto-archived after 7 days)
- [x] Create Main Pokémon List Page (Laravel Blade & Controller) (2025-08-12)
- [x] Create Pokémon Detail Page (Laravel Blade & Controller) (2025-08-12)
- [x] Setup project structure (2025-08-12)

## Maintenance Rules
1. When prompting to update:
   "Update TASK.md: [action] [task details] [metadata]"
   Example: 
   "Update TASK.md: Mark #auth as complete and add 'Optimize DB queries' as P1 task owned by @dev2"

2. Automatic handling:
   - Detect "done"/"complete" in conversation → move to Completed
   - New requirements mentioned → add to Backlog
   - Urgent findings → add to Discoveries with ❗

3. Formatting:
   - Use GitHub-flavored markdown
   - Group related tasks with ## headers