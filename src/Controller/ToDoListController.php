<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
    
    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function createTask()
    {
        exit("To do: create a task");
    }
    
    /**
     * @Route("/switch-status/{id}", name="switch_status")
     */
    public function switchStatus($id)
    {
        exit("To do: switch the status! id:$id");
    }
    
    /**
     * @Route("/delete/{id}", name="task_delete")
     */
    public function deleteTask($id)
    {
        exit("To do: delete the task! id:$id");
    }
}
