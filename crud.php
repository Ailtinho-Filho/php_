<?php

// Classe User
class User {
    private $id;
    private $name;
    private $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}

// Classe UserRepository
class UserRepository {
    private $users;

    public function __construct() {
        $this->users = array();
    }

    public function create(User $user) {
        $this->users[] = $user;
    }

    public function readAll() {
        return $this->users;
    }

    public function read($id) {
        foreach ($this->users as $user) {
            if ($user->getId() == $id) {
                return $user;
            }
        }
        return null;
    }

    public function update(User $user) {
        foreach ($this->users as &$u) {
            if ($u->getId() == $user->getId()) {
                $u = $user;
                return;
            }
        }
    }

    public function delete($id) {
        foreach ($this->users as $key => $user) {
            if ($user->getId() == $id) {
                unset($this->users[$key]);
                return;
            }
        }
    }
}

// Criar um repositório de usuários
$userRepository = new UserRepository();

// Criar usuários
$user1 = new User(1, 'João', 'joao@example.com');
$user2 = new User(2, 'Maria', 'maria@example.com');
$user3 = new User(3, 'Pedro', 'pedro@example.com');

// Adicionar usuários ao repositório
$userRepository->create($user1);
$userRepository->create($user2);
$userRepository->create($user3);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP e Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">CRUD com PHP e Bootstrap</h1>
        <hr>

        <!-- Formulário de criação de usuário -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Criar</button>
        </form>

        <!-- Tabela de usuários -->
        <h2>Usuários</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userRepository->readAll() as $user) { ?>
                    <tr>
                        <td><?php echo $user->getId(); ?></td>
                        <td><?php echo $user->getName(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $user->getId(); ?>" class="btn btn-secondary">Editar</a>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $user->getId(); ?>&delete=true" class="btn btn-danger">Deletar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php if (isset($_GET['id'])) { ?>
            <?php $


<?php if (isset($_GET['id'])) { ?>
    <?php $user = $userRepository->read($_GET['id']); ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $user->getName(); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo $user->getEmail(); ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
    </form>
<?php } ?>

<!-- Processamento de requisições -->
<?php
if (isset($_POST['create'])) {
    $user = new User(null, $_POST['name'], $_POST['email']);
    $userRepository->create($user);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['update'])) {
    $user = new User($_POST['id'], $_POST['name'], $_POST['email']);
    $userRepository->update($user);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['delete'])) {
    $userRepository->delete($_GET['id']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

</div>
</body>
</html>